<?php

namespace App\Http\Controllers\FrontControllers;

use App\Models\{Booking, ContactInformation, Coupons, User};
use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Jobs\UserRegistered;
use App\Repositories\BookingRepository;
use App\Traits\InvoiceNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Log, DB, Hash};
use Barryvdh\Snappy\Facades\SnappyPdf;
use Exception;

class BookingController extends Controller
{
    use InvoiceNumber;
    public function makePayment(Request $request, BookingRepository $bookingRepository, $bookingId = null)
    {
        if (request()->expectsJson()) {
            $bookingDetails = $bookingRepository->bookingDetails($request->bookingId);
        } else {
            $bookingDetails = $bookingRepository->bookingDetails(base64_decode($bookingId));
        }
        $nights = stayNights($bookingDetails?->check_in_date, $bookingDetails?->check_out_date);
        $nights = $nights == 0  ? 1 : $nights;
        $roomDetails = $bookingDetails?->bookedRooms;

        $totalPayableAmount = $bookingDetails?->bookedRooms->sum('total_price') ?? 0;
        $couponAmount = $bookingRepository->getCouponAmount($bookingDetails?->coupon_id, $totalPayableAmount);
        $totalPayableAmount = $totalPayableAmount - $couponAmount;
        $coupons = Coupons::select('id', 'code', 'title', 'description', 'type', 'value', 'auto_apply', 'is_visible')
            ->where('is_active', 1)
            ->whereDate('expiration_date', '>=', now())
            ->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('usage_limit', '>', 0)
                        ->where('used_count', '<', DB::raw('usage_limit'));
                })
                    ->orWhere(function ($query) {
                        $query->where('usage_limit', '=', 0);
                    });
            })->get();

        if (request()->expectsJson()) {
            return response()->json([
                'status' => 200,
                'message' => 'Payment details retrieved successfully',
                'data' => [
                    'bookingDetails' => $bookingDetails,
                    'nights' => $nights,
                    'roomDetails' => $roomDetails,
                    'coupons' => $coupons,
                    'totalPayableAmount' => $totalPayableAmount,
                    'couponAmount' => $couponAmount
                ]
            ]);
        }
        return view('front.make-payment', compact('bookingDetails', 'nights', 'roomDetails', 'coupons', 'totalPayableAmount', 'couponAmount'));
    }

    public function manageBooking($bookingId = null, BookingRepository $bookingRepository)
    {
        $manageBooking =  $bookingRepository->manageBooking();
        return view('front.manage-booking', compact('manageBooking'));
    }

    public function downloadInvoice($bookingId)
    {
        $booking = Booking::with('bookedRooms', 'transactions', 'invoice')->findOrFail(decode($bookingId));
        $invoiceData = [
            'invoice_number' => !empty($booking->invoice?->invoice_number) ? $booking->invoice?->invoice_number : $this->generateInvoiceNumber(),
            'invoice_date'   => now()->toDateString(),
        ];
        $booking->invoice()->updateOrCreate(
            ['booking_id' => $booking->id],
            $invoiceData
        );
        $pdf = SnappyPdf::loadView('front.pdf.payment-receipt', compact('booking'));
        return $pdf->download('invoice_' . $booking->booking_id . '.pdf');
    }

    public function downloadTaxInvoice($bookingId)
    {
        $businessDetails = User::select('business_name', 'business_logo', 'business_site', 'pan_number', 'gst_number', 'gst_text', 'pan_text')->where('id', 1)->first();
        $booking = Booking::with('bookedRooms', 'transactions', 'invoice')->findOrFail(decode($bookingId));
        $invoiceData = [
            'invoice_number' => !empty($booking->invoice?->invoice_number) ? $booking->invoice?->invoice_number : $this->generateInvoiceNumber(),
            'invoice_date'   => now()->toDateString(),
        ];
        $booking->invoice()->updateOrCreate(
            ['booking_id' => $booking->id],
            $invoiceData
        );
        return view('front.pdf.tax-invoice', compact('booking', 'businessDetails'));
        $pdf = SnappyPdf::loadView('front.pdf.tax-invoice', compact('booking', 'businessDetails'));
        return $pdf->download('invoice_' . $booking->booking_id . '.pdf');
    }

    public function addBookingMultipleDetails(BookingRequest $request, BookingRepository $bookingRepository)
    {

        try {
            if (!$request->hotelId || !$request->search_id) {
                return redirect(route('home'))->with('error', 'Search For Best Hotels & book now!');
            }

            if (!Auth::check()) {

                $checkUser = User::where('email', $request->contact_email)->first();
                if (!empty($checkUser->id)) {
                    if (empty($checkUser?->phone)) {
                        $checkUser->phone = $request->contact_no;
                        $checkUser->save();
                    }
                    Auth::login($checkUser);
                } else {
                    $password = randomPassword();
                    $newUser = User::create([
                        'name' => $request->contact_name,
                        'email' => $request->contact_email,
                        'phone' => $request->contact_no,
                        'password' => Hash::make($password),
                    ]);
                    $newUser->assignRole('User');
                    UserRegistered::dispatch($newUser, $password);
                    Auth::login($newUser);
                }
            }

            $addBooking = $bookingRepository->addMultipleBooking($request);
            if (!$addBooking) {
                return response()->json(['status' => 400, 'message' => 'Something went wrong'], 400);
            }

            $bookingRepository->addTravellerDetails($request, $addBooking);
            return response()->json([
                'status' => 200,
                'message' => 'Booking saved successfully',
                'redirect' => Route('add.paymentPage', ['bookingId' => base64_encode($addBooking)])
            ], 200);
        } catch (Exception $e) {
            Log::error('addBookingMultipleDetails error: ' . $e);
            return response()->json(['status' => 500, 'message' => 'Internal server error'], 500);
        }
    }

    public function applyCoupon(Request $request, BookingRepository $bookingRepository)
    {
        try {
            $action = $request->action;
            $type = $request->type;

            if ($request->ajax()) {
                $bookingId = base64_decode($request->booking_id);
            } elseif ($request->expectsJson()) {
                $bookingId = $request->booking_id;
            }

            $booking = Booking::with('bookedRooms')
                ->where('booking_id', $bookingId)
                ->firstOrFail();

            $totalPayableAmount = $booking->bookedRooms->sum('total_price') ?? 0;

            if ($action === 'remove') {
                $booking->update(['coupon_id' => null]);
                return $this->jsonResponse(200, 'Coupon Removed successfully!', 0, $totalPayableAmount);
            }

            // Fetch coupon with conditions
            $coupon = Coupons::select('id', 'code', 'title', 'description', 'type', 'value', 'auto_apply', 'is_visible')
                ->where('is_active', 1)
                ->whereDate('expiration_date', '>=', now())
                ->where(function ($query) {
                    $query->where(function ($query) {
                        $query->where('usage_limit', '>', 0)
                            ->whereColumn('used_count', '<', 'usage_limit');
                    })->orWhere('usage_limit', 0);
                })
                ->when($type === 'coupon_code', fn($query) => $query->where('code', $request->coupon))
                ->when($type === 'coupon', fn($query) => $query->where('id', decode($request->coupon)))
                ->firstOrFail();

            // Calculate coupon discount
            $couponDiscount = $coupon->type === 'percent'
                ? ($totalPayableAmount * $coupon->value) / 100
                : $coupon->value;

            // Update booking with coupon ID
            $booking->update(['coupon_id' => $coupon->id]);

            return $this->jsonResponse(200, 'Coupon applied successfully', $couponDiscount, $totalPayableAmount - $couponDiscount);
        } catch (Exception $e) {
            Log::error('applyCoupon error: ' . $e->getMessage());
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    private function jsonResponse($status, $message, $couponDiscount, $totalPayableAmount)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'couponDiscount' => _nf($couponDiscount),
            'totalPayableAmount' => _nf($totalPayableAmount),
        ]);
    }

    public function addConsultNow(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required',
            'city' => 'required|string',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date',
            'total_guest' => 'required',
            'total_room' => 'required',
            'rating' => 'required',
            'hotel_id' => 'required',
            'city_id' => 'required'
        ], [
            'full_name.required' => 'Full Name is required.',
            'full_name.string' => 'Full Name must be a valid string.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'Phone number is required.',
            'city.string' => 'City must be a valid string.',
            'checkin_date.required' => 'Check-in date is required.',
            'checkin_date.date' => 'Please enter a valid check-in date.',
            'checkout_date.required' => 'Check-out date is required.',
            'checkout_date.date' => 'Please enter a valid check-out date.',
            'total_guest.required' => 'Total number of guests is required.',
            'total_room.required' => 'Total number of rooms is required.',
            'rating.required' => 'Rating is required.',
            'hotel_id.required' => 'Hotel name is required.',
            'city_id.required' => 'City name is required.'
        ]);


        DB::beginTransaction();

        try {
            $booking = new Booking();
            $booking->hotel_id = $request->hotel_id ?? null;
            $booking->check_in_date = $request->checkin_date;
            $booking->check_out_date = $request->checkout_date;
            $booking->total_guest = $request->total_guest;
            $booking->total_room = $request->total_room;
            $booking->status = 'Pending';
            $booking->special_requirements = 'consult-now';
            $booking->save();

            $booking = $booking->refresh();

            $traveler = new ContactInformation();
            $traveler->booking_id = $booking->booking_id;
            $traveler->name = $request->full_name;
            $traveler->email = $request->email;
            $traveler->mobile = $request->phone;
            $traveler->city_name = $request->city;
            $traveler->save();
            DB::commit();
            return response()->json(['status' => 200, 'message' => 'Information sent successfully', 'redirect' => url()->previous()], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'status' => 500,
                'message' => 'An unexpected error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}
