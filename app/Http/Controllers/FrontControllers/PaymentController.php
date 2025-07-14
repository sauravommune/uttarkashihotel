<?php

namespace App\Http\Controllers\FrontControllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Jobs\AlertAdminsBookingJob;
use App\Jobs\BookingPendingJob;
use App\Models\AdminSettings;
use App\Repositories\BookingRepository;
use App\Models\Payment;
use App\Repositories\PaymentRepository;
use App\Models\Booking;
use App\Models\Coupons;
use App\Models\RatePlan;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Exception;


class PaymentController extends Controller
{

    public function orderCreate(Request $request, BookingRepository $bookingRepository, PaymentRepository $paymentRepository)
    {
        try {

            if ($request->ajax()) {
                $bookingDetails = $bookingRepository->bookingDetails(base64_decode($request->bookingId));
            } elseif ($request->expectsJson()) {
                $bookingDetails = $bookingRepository->bookingDetails($request->bookingId);
            }
            $paymentMethod  = $request->method ?? "";
            $amount         = $bookingDetails?->bookedRooms->sum('total_price');
            $vendorCost     = $bookingDetails?->bookedRooms->sum('vendor_cost');
            $markup         = $bookingDetails?->bookedRooms->sum('markup');

            $couponAmount = $bookingRepository->getCouponAmount($bookingDetails->coupon_id, $amount);
            $payableAmount = $amount - $couponAmount;

            $razorpayConfig = AdminSettings::select('id', 'payment_gateways')->first();
            if (isset($razorpayConfig->payment_gateways['razorpay'])) {
                $razorpayConfig = $razorpayConfig->payment_gateways['razorpay'];
            } else {
                throw new Exception('Razorpay config not found');
            }

            $payment = Payment::where('booking_id', $bookingDetails->booking_id)->where('is_initial', 1)->first();
            $merchantOrderId = $payment->merchant_order_id ?? generateOrderId();
            if (!empty($payment) && !empty($payment->order_id)) {
                $orderId = $payment->order_id;
                $orderAmount = $payment->amount;
            } else {
                $api = new Api($razorpayConfig['key_id'], $razorpayConfig['key_secret']);
                $orderData = [
                    'receipt'   => 'receipt_' . time(),
                    'amount'    => $payableAmount * 100,
                    'currency'  => 'INR',
                    'notes' => [
                        "booking_id" => $bookingDetails->booking_id,
                        'merchant_order_id' => $merchantOrderId
                    ],
                ];
                $order = $api->order->create($orderData);
                $orderId = $order['id'];
                $orderAmount = $order['amount'];
            }

            $data = array(
                'order_id'          => $orderId,
                'booking_id'        => $bookingDetails->booking_id,
                'payableAmount'     => $payableAmount,
                'vendorCost'        => $vendorCost,
                'markup'            => $markup - $couponAmount,
                'paymentMethod'     => $paymentMethod,
                'couponAmount'      => $couponAmount,
                'merchant_order_id' => $merchantOrderId
            );
            $paymentRepository->addBookingId($data);

            $options = array(
                'key'       => $razorpayConfig['key_id'],
                'amount'    => $orderAmount,
                'description'   => "Booking Payment For " . $bookingDetails->booking_id,
                'order_id'      => $orderId,
                'prefill'   => array(
                    'name'      => $bookingDetails->contactInfo->name,
                    'email'     => $bookingDetails->contactInfo->email,
                    'contact'   => $bookingDetails->contactInfo->mobile
                ),
                "readonly"      => [
                    "contact"   => true,
                    "email"     => true
                ],
                'notes' => [
                    "booking_id" => $bookingDetails->booking_id,
                    'merchant_order_id' => $merchantOrderId
                ],
                'theme' => [
                    'color' => "#F37254"
                ],
                'method'    => $request->method,
                "method"        => array(
                    "netbanking"    => $request->method == 'netBanking' ? true : false,
                    "card"          => $request->method == 'card' ? true : false,
                    "upi"           => $request->method == 'upi' ? true : false,
                    "wallet"        => $request->method == 'wallet' ? true : false,
                    "emi"           => $request->method == 'emi' ? true : false,
                    "paylater"      => $request->method == 'payLater' ? true : false,
                    "cardless_emi"  => $request->method == 'cardless_emi' ? true : false
                ),
                "callback_url"      => route('payment.callback'),
            );

            return response()->json([
                'status'    => 200,
                'options'   => $options
            ]);
        } catch (\Razorpay\Api\Errors\BadRequestError $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function paymentCallBack(Request $request)
    {
        $razorpayConfig = AdminSettings::select('id', 'payment_gateways')->first();
        if (isset($razorpayConfig->payment_gateways['razorpay'])) {
            $razorpayConfig = $razorpayConfig->payment_gateways['razorpay'];
        } else {
            throw new Exception('Razorpay config not found');
        }
        $api = new Api($razorpayConfig['key_id'], $razorpayConfig['key_secret']);

        try {
            $attributes = array(
                'razorpay_order_id'     => $request->razorpay_order_id,
                'razorpay_payment_id'   => $request->razorpay_payment_id,
                'razorpay_signature'    => $request->razorpay_signature
            );
            $api->utility->verifyPaymentSignature($attributes);
        } catch (SignatureVerificationError $e) {
            $message = 'Payment Error : ' . $e->getMessage();
            return response()->json(['status' => 500, 'message' => $message]);
        }

        try {
            $payment = $api->payment->fetch($request->razorpay_payment_id);

            $transaction = Payment::where('order_id', $payment->order_id)->first();
            $transaction->payment_id    = $payment->id;
            $transaction->gateway_fee   = !empty($payment['fee']) ? $payment['fee'] / 100 : 0;
            $transaction->gateway_tax   = !empty($payment['tax']) ? $payment['tax'] / 100 : 0;
            $transaction->status        = $payment['status'];
            $transaction->save();
            $this->updateAvailability($transaction->booking_id);

            BookingPendingJob::dispatch($transaction->booking_id, auth()->user()->id);
            AlertAdminsBookingJob::dispatch($transaction->booking_id);
            $bookingId = base64_encode($transaction->booking_id);
            return redirect()->route('manage.booking', $bookingId);
        } catch (Exception $e) {
            $message = 'Payment Error : ' . $e->getMessage();
            return response()->json(['status' => 500, 'message' => $message]);
        }
    }


    public function updateAvailability($booking_id)
    {
        $bookingData = Booking::where('booking_id', $booking_id)->first();
        $bookedRooms = $bookingData?->bookedRooms;
        $hotel_id = $bookingData?->hotel_id;
        $checkIn  = $bookingData->check_in_date;
        $checkOut = $bookingData->check_out_date;

        if (!empty($bookingData->coupon_id)) {
            Coupons::where('id', $bookingData->coupon_id)->update(['used_count' => DB::raw('used_count + 1')]);
        }

        if (!$bookedRooms) {
            return; // No booked rooms found, exit the function
        }
        $quantitiesByRoom = $bookedRooms->groupBy('room_id')->map(function ($group) {
            return $group->sum('quantity');
        });

        foreach ($quantitiesByRoom as $roomId => $totalQuantity) {
            RatePlan::where('hotel_id', $hotel_id)->where('room_type', $roomId)
                ->where('pricing_date', '>=', $checkIn)->where('pricing_date', '<', $checkOut)
                ->update(['availability' => DB::raw("GREATEST(availability - $totalQuantity, 0)")]);
        }
    }
}
