<?php

namespace App\Http\Controllers;

use App\DataTables\BookingTransactionsDataTable;
use App\DataTables\BookingVendorTransactionsDataTable;
use App\DataTables\TransactionsDataTable;
use App\DataTables\VendorTransactionsDataTable;
use App\Models\AdminSettings;
use App\Models\Booking;
use App\Models\Hotel;
use App\Models\Payment;
use App\Models\VendorTransaction;
use App\Services\LeadRemarkLogger;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Razorpay\Api\Api;
use Exception;

class TransactionsController extends Controller
{
    public function clientTransactions(TransactionsDataTable $dataTable)
    {
        $title = 'Client Transactions';
        $totalSum = Payment::whereIn('status', ['captured', 'authorized'])->sum('amount');
        addVendors(['datatable', 'tinyMCE', 'jquery-validate', 'sweetalert']);
        return view('transactions.index', compact('title', 'totalSum'));
    }


    public function clientTransactionsDataTable(TransactionsDataTable $dataTable)
    {
        return $dataTable->render();
    }

    public function vendorTransactions(VendorTransactionsDataTable $dataTable)
    {
        $title = 'Vendor Transactions';
        $hotels = Hotel::select('id', 'name', 'city')->whereHas('VendorTransaction')->get();
        addVendors(['datatable', 'tinyMCE', 'jquery-validate', 'sweetalert']);
        return $dataTable->render('transactions.vendor', compact('title', 'hotels'));
    }

    public function vendorTotalPaid(Request $request)
    {
        $startDate = request('startDate') ? Carbon::parse(request('startDate'))->startOfDay()->format('Y-m-d') : Carbon::now()->subDays(30)->startOfDay()->format('Y-m-d');
        $endDate = request('endDate') ? Carbon::parse(request('endDate'))->endOfDay()->format('Y-m-d') : Carbon::now()->endOfDay()->format('Y-m-d');
        $searchGlobal = request('searchGlobal');
        $totalPaid = VendorTransaction::when(!empty($searchGlobal), function ($query) use ($searchGlobal) {
            $query->where('payment_id', 'like', '%' . $searchGlobal . '%')
                ->orWhereHas('booking', fn($q) => $q->where('booking_id', 'like', '%' . $searchGlobal . '%'))
                ->orWhereHas('hotel', fn($q) => $q->where('name', 'like', '%' . $searchGlobal . '%'));
        })
            ->when(!empty(request('hotel_id')), function ($query) {
                $query->where('hotel_id', request('hotel_id'));
            })
            ->whereBetween('payment_date', [$startDate, $endDate])->sum('amount');
        return response()->json(['status' => 200, 'totalPaid' => '₹ ' . _nf($totalPaid)]);
    }

    public function bookingMarkup($bookingId)
    {
        $booking = Booking::select('id', 'booking_id')->findOrFail(decode($bookingId));
        $transactions = $booking->transactions()->whereIn('status', ['captured', 'authorized'])->get();
        return response()->json([
            'status'    => 200,
            'expected_markup' => $booking->bookedRooms()->sum('markup'),
            'current_markup' => $transactions->sum('amount') - $transactions->sum('cost'),
            'coupon_discount' => $transactions->sum('coupon')
        ]);
    }

    public function transactionsDatatable(BookingTransactionsDataTable $dataTable)
    {
        return $dataTable->render('lead.index');
    }

    public function transactionsForm($bookingId = '', $payment = null)
    {
        $paymentId = decode($payment);
        $payment = Payment::findOrNew($paymentId);
        $html = view('transactions.form', compact('bookingId', 'payment'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function saveTransaction(Request $request)
    {
        $request->validate([
            'payment_mode'      => 'required|in:manual,razorpay',
            'payment_method'    => 'required_if:payment_mode,manual',
            'payment_date'      => 'required|date',
            'amount'            => [
                'required_if:payment_mode,manual',
                Rule::when(
                    $request->input('payment_mode') === 'manual',
                    ['numeric', 'gt:0']
                ),
                Rule::when(
                    $request->input('payment_mode') === 'razorpay' && $request->input('is_payment_link') == '1',
                    ['numeric', 'gt:0']
                )
            ],
            'is_payment_link'   => 'required_if:payment_mode,razorpay|in:0,1',
        ]);

        $request->validateWithBag('payment', [
            'payment_id' => function ($attribute, $value, $fail) use ($request) {
                if (
                    $request->input('payment_mode') === 'razorpay' &&
                    $request->input('is_payment_link') == '0' &&
                    empty($value)
                ) {
                    $fail('The payment ID is required when medium is Razorpay Payment Entry.');
                }
            },
        ]);

        $booking = Booking::with('bookingContact')->where('booking_id', $request->bookingId)->first();

        try {
            $paymentId = decode($request->id);
            $payment = Payment::findOrNew($paymentId);

            $merchantOrderId = $payment->merchant_order_id ?? generateOrderId();

            if ($request->payment_mode == 'razorpay') {
                $razorpayConfig = AdminSettings::select('id', 'payment_gateways')->first();
                if (isset($razorpayConfig->payment_gateways['razorpay'])) {
                    $razorpayConfig = $razorpayConfig->payment_gateways['razorpay'];
                } else {
                    throw new Exception('Razorpay config not found');
                }
                $api = new Api($razorpayConfig['key_id'], $razorpayConfig['key_secret']);

                if ($request->is_payment_link == 0) {
                    try {
                        $transaction = $api->payment->fetch($request->payment_id);
                    } catch (Exception $e) {
                        throw new Exception('Payment not found in Razorpay!');
                    }

                    $payment->order_id          = $transaction['order_id'];
                    $payment->gateway_fee       = !empty($transaction['fee']) ? $transaction['fee'] / 100 : 0;
                    $payment->gateway_tax       = !empty($transaction['tax']) ? $transaction['tax'] / 100 : 0;
                    $payment->status            = $transaction['status'];
                    $payment->amount            = $transaction['amount'] / 100;
                    $payment->payment_method    = $transaction['method'];
                } else {
                    try {
                        $paymentLink = $api->paymentLink->create(
                            [
                                'amount' => $request->amount * 100,
                                'currency' => 'INR',
                                'reference_id' => 'receipt_' . time(),
                                'description' => 'Payment for ' . $booking->booking_id,
                                'customer' => [
                                    'name' => $booking->bookingContact->name,
                                    "email" => $booking->bookingContact->email,
                                    "contact" => $booking->bookingContact->mobile,
                                ],
                                'notify' => ['sms' => true, 'email' => true],
                                'reminder_enable' => true,
                                'notes' => [
                                    "booking_id" => $booking->booking_id,
                                    'merchant_order_id' => $merchantOrderId
                                ],
                            ]
                        );
                        $payment->is_payment_link   = true;
                        $payment->payment_link      = $paymentLink->short_url;
                        $payment->amount            = $request->amount;
                        $payment->status            = 'pending';
                    } catch (\Exception $e) {
                        return response()->json(['status' => 500, 'message' => $e->getMessage()]);
                    }
                }
            } else {
                $payment->status            = 'captured';
                $payment->amount            = $request->amount;
                $payment->payment_method    = $request->payment_method;
            }
            $payment->mode              = $request->payment_mode;
            $payment->booking_id        = $booking->booking_id;
            $payment->payment_id        = $request->payment_id;
            $payment->merchant_order_id = $merchantOrderId;
            $payment->user_id           = Auth::user()->id;
            $payment->created_at        = $request->payment_date;
            $payment->remarks           = $request->remarks;
            $payment->save();

            $response = ['status' => 200, 'message' => 'Transaction saved successfully'];
            if ($request->payment_mode == 'razorpay') {
                $response = $request->is_payment_link
                    ? ['status' => 200, 'message' => 'Payment Link Generated Successfully.', 'razorpay_link' => $paymentLink->short_url]
                    : $response;
            }

            $remark = 'Payment Received via ' . $payment->mode . ' for ₹' . $payment->amount;
            LeadRemarkLogger::logChanges([], [], $booking->id, "payment", $remark, true);

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($transactionId)
    {
        Payment::where('id', decode($transactionId))->delete();
        return response()->json([
            'status' => 200,
            'message' => 'Transaction deleted successfully',
        ], 200);
    }

    public function vendorTransactionsDatatable(BookingVendorTransactionsDataTable $dataTable)
    {
        return $dataTable->render('lead.index');
    }

    public function vendorTransactionsForm($bookingId, $payment = null)
    {
        $paymentId = decode($payment);
        $payment = VendorTransaction::findOrNew($paymentId);
        $html = view('transactions.vendor-form', compact('bookingId', 'payment'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function vendorTransactionsSave(Request $request)
    {
        $request->validate([
            'booking_id'        => 'required',
            'payment_method'    => 'required',
            'payment_date'      => 'required',
            'payment_id'        => 'required',
            'amount'            => 'required|numeric|gt:0',
            'remarks'           => 'nullable|string',
        ]);

        $bookingId = decode($request->booking_id);

        $hotelId = Booking::select('id', 'hotel_id')->findOrFail($bookingId)->hotel_id;

        $payment = VendorTransaction::findOrNew(decode($request->id));
        $payment->booking_id        = $bookingId;
        $payment->hotel_id           = $hotelId;
        $payment->payment_id        = $request->payment_id;
        $payment->payment_method    = $request->payment_method;
        $payment->payment_date      = Carbon::parse($request->payment_date)->format('Y-m-d');
        $payment->amount            = $request->amount;
        $payment->receipt           = FileUpload::fileUpload('receipt', 'uploads/receipt', false, $payment->receipt);
        $payment->save();

        $remark = 'Paid to Vendor via ' . $payment->payment_method . ' for ₹' . $payment->amount;
        LeadRemarkLogger::logChanges([], [], $bookingId, "payment", $remark, true);

        return response()->json(['success' => true, 'message' => 'Vendor Transaction saved successfully!']);
    }

    public function capturePayment($paymentId)
    {
        try {
            $transaction = Payment::with(['booking:id,booking_id'])->findOrFail(decode($paymentId));

            if ($transaction->mode == 'razorpay') {
                $razorpayConfig = AdminSettings::select('id', 'payment_gateways')->first();
                if (isset($razorpayConfig->payment_gateways['razorpay'])) {
                    $razorpayConfig = $razorpayConfig->payment_gateways['razorpay'];
                } else {
                    throw new Exception('Razorpay config not found');
                }
                $api = new Api($razorpayConfig['key_id'], $razorpayConfig['key_secret']);
                $payment = $api->payment->fetch($transaction->payment_id);
                if ($payment->status == 'authorized') {
                    $payment_capture = $payment->capture(['amount' => ($transaction?->amount * 100), 'currency' => 'INR']);
                    $transaction->update([
                        'status'        => $payment_capture->status,
                        'gateway_fee'   => !empty($payment_capture->fee) ? $payment_capture->fee / 100 : 0,
                        'gateway_tax'   => !empty($payment_capture->tax) ? $payment_capture->tax / 100 : 0,
                    ]);
                } else {
                    $transaction->update([
                        'status'        => $payment->status,
                    ]);
                }

                $remark = 'Payment captured via Razorpay for ₹' . $transaction->amount;
                LeadRemarkLogger::logChanges([], [], $transaction->booking->id, "payment", $remark, true);
            }
            return response()->json(['status' => 200, 'message' => 'Transaction captured successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }
}
