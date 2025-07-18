<?php

namespace App\Repositories;

use App\Models\ContactInformation;
use App\Models\TravellerDetails;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Coupons;
use App\Models\SearchLog;
use App\Models\User;
use App\Services\LeadRemarkLogger;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;

class BookingRepository extends BaseRepository
{

    public function addTravellerDetails($request, $add_booking)
    {
        $addContactInfo = ContactInformation::firstOrNew(['booking_id' => $add_booking]);
        $addContactInfo->booking_id = $add_booking;
        $addContactInfo->name = $request->contact_name;
        $addContactInfo->email = $request->contact_email;
        $addContactInfo->mobile = $request->contact_no;
        $addContactInfo->is_gst_opted = $request->is_gst_opted ? true : false;
        $addContactInfo->gst_number = $request->gst_number;
        $addContactInfo->company_name = $request->company_name;
        $addContactInfo->save();

        TravellerDetails::where('booking_id', $add_booking)->delete();
        foreach ($request['full_name'] as $index => $adultName) {
            if (!empty($adultName)) {
                // $dobString = $request['year'][$index].'-'.$request['month'][$index].'-'.$request['date'][$index];
                // $dob = new DateTime($dobString);
                // $dob = $dob->format('Y-m-d'); 

                TravellerDetails::create([
                    'booking_id' => $add_booking,
                    'name' => $adultName,
                    'email' => $request['email'][$index] ?? '',
                    'gender' => $request['gender'][$index],
                    'dob' => null,

                ]);
            }
        }

        if (isset($request['child_full_name']) && count($request['child_full_name']) > 0) {
            foreach ($request['child_full_name'] as $index => $childName) {
                if (!empty($childName)) {

                    $dobString = $request['child_year'][$index] . '-' . $request['child_month'][$index] . '-' . $request['child_date'][$index];
                    $dob = new DateTime($dobString);
                    $dob = $dob->format('Y-m-d');
                    TravellerDetails::create([
                        'booking_id' => $add_booking,
                        'name' => $childName,
                        'email' => '',
                        'gender' => $request['child_gender'][$index],
                        'dob' => $dob
                    ]);
                }
            }
        }
        return $add_booking;
    }

    public function bookingDetails($bookingId)
    {
        $booking = Booking::where('booking_id', $bookingId)->first();
        return $booking;
    }

    public function getCouponAmount($couponId, $amount)
    {
        $coupon = Coupons::select('id', 'code', 'title', 'description', 'type', 'value', 'auto_apply', 'is_visible')->where('id', $couponId)->first();
        if (empty($coupon)) {
            return 0;
        }
        return $coupon->type === 'percent'
            ? ($amount * $coupon->value) / 100
            : $coupon->value;
    }

    public function manageBooking()
    {
        $bookingData = [];
        if (request('bookingId')) {
            if (request()->expectsJson()) {
                $bookingId = request('bookingId');
            } else {
                $bookingId = base64_decode(request('bookingId'));
            }
            $booking_data = Booking::with(['hotel.amenities' => function ($query) {
                $query->orderBy('id', 'desc')->limit(6);
            }, 'bookedRooms.roomDetails', 'bookingTraveler', 'bookingContact', 'transactions', 'payments'])->where('booking_id', $bookingId)->first();
            $nights = (strtotime($booking_data->check_out_date) - strtotime($booking_data->check_in_date)) / (60 * 60 * 24);

            $bookingData =  [
                'details' => $booking_data,
                'nights'   => ($nights == 0 ? 1 : $nights),
                'totalRoom' => $booking_data->bookedRooms->pluck('quantity')->sum(),
                'totalGuest' => $booking_data->total_guest,
                'totalAmount' => $booking_data->bookedRooms->pluck('total_price')->sum(),
                'hotelAmenity' => $booking_data->hotel->amenities->map(function ($amenity) {
                    return [
                        'id'   => $amenity->id,
                        'name' => $amenity?->amenityName?->name ?? "",  // extra key for api hotel amenity
                    ];
                }),
                'roomAmenity' => $booking_data->bookedRooms->map(function ($room) {
                    return [
                        'room_id'    => $room->id,
                        'amenities'  => $room->roomDetails->addAmenity->map(function ($amenity) {
                            return [
                                'id'   => $amenity->id,
                                'name' => $amenity?->amenityName?->name ?? '', // extra key for api room amenity
                            ];
                        }),
                    ];
                }),
            ];

            return $bookingData;
        }
    }

    public function addMultipleBooking($request)
    {

        $searchId       = $request->search_id;
        $searchData     = SearchLog::findOrFail($searchId);
        $checkIn        = $searchData->checkin_date;
        $checkOut       = $searchData->checkout_date;
        $adult          = (int) $searchData->adultCount;
        $child          = (int) $searchData->childCount;
        $totalGuests    = $adult + $child;

        $booking = Booking::where('search_id', $searchId)->where('user_id', auth()->id())->firstOrNew();

        $booking->user_id               = auth()->id();
        $booking->hotel_id              = (int)$request->hotelId;
        $booking->search_id             = $searchId;
        $booking->total_guest           = $totalGuests;
        // $booking->total_room         = count($request->roomId);
        $booking->total_room            = array_sum($request->quantity);
        $booking->child                 = $child;
        $booking->adult                 = $adult;
        $booking->check_in_date         = $checkIn;
        $booking->check_out_date        = $checkOut;
        $booking->special_requirements  = $request->specialRequirements ?? '';
        $booking->arrival_time          = $request->arrival_time;
        if (session()->has('referral_code')) {
            $affiliate_code = session('referral_code');
            $affiliate_user = User::where('affiliate_code', $affiliate_code)->first(['id', 'affiliate_code']);
            $booking->referred_by = $affiliate_user->id;
        }
        $booking->save();
        session()->forget('referral_code');
        $booking = $booking->refresh();

        $nights = Carbon::parse($checkIn)->diffInDays(Carbon::parse($checkOut));
        $bookedRoomDetails = [];

        $booking->bookedRooms()->delete();

        foreach ($request->roomId as $key => $roomId) {
            $roomDetails = Room::with(['ratePlan' => function ($query) use ($checkIn, $checkOut) {
                $query->where('pricing_date', '>=', $checkIn)->where('pricing_date', '<', $checkOut);
            }])->find($roomId);

            $category   = $request->category[$key];
            $quantity   = (int) $request->quantity[$key];
            $totalPrice = $totalCost = $totalMarkup = 0;

            if ($roomDetails && $roomDetails->ratePlan->isNotEmpty()) {

                $ratePlanCount = $roomDetails->ratePlan->count();

                $totalAmountEP = $roomDetails->ratePlan->sum('total_amount_ep') / $ratePlanCount;
                $totalAmountCP = $roomDetails->ratePlan->sum('total_amount_cp') / $ratePlanCount;
                $totalAmountMAP = $roomDetails->ratePlan->sum('total_amount_map') / $ratePlanCount;
                $totalAmountAP = $roomDetails->ratePlan->sum('total_amount_ap') / $ratePlanCount;


                $totalCostEP = $roomDetails->ratePlan->sum('b2b_rate_ep') / $ratePlanCount;
                $totalCostCP = $roomDetails->ratePlan->sum('b2b_rate_cp') / $ratePlanCount;
                $totalCostMAP = $roomDetails->ratePlan->sum('b2b_rate_map') / $ratePlanCount;
                $totalCostAP = $roomDetails->ratePlan->sum('b2b_rate_ap') / $ratePlanCount;


                $totalMarkupEP = $roomDetails->ratePlan->sum('markup_ep') / $ratePlanCount;
                $totalMarkupCP = $roomDetails->ratePlan->sum('markup_cp') / $ratePlanCount;
                $totalMarkupMAP = $roomDetails->ratePlan->sum('markup_map') / $ratePlanCount;
                $totalMarkupAP = $roomDetails->ratePlan->sum('markup_ap') / $ratePlanCount;


                // start code extra person price
                $totalGest = $booking->total_guest;
                $stayGuest = $roomDetails->stay_guest;
                $roomCount = $booking->total_room;

                if ($roomDetails->ratePlan->count() > 0 && $roomDetails->ratePlan) {

                    $ratePlan = $roomDetails->ratePlan;
                    // ✅ EP: Room Only
                    $epData = calculateExtraPersonPrice($ratePlan, $totalGest, $stayGuest, $roomCount, 'ep');
                    $extraPersonAmountEP   = ($epData['ep_average_extra_person_price'] ?? 0) * $nights;
                    $extraPersonCostEP     = ($epData['ep_extra_person_price'] ?? 0) * $nights;
                    $extraPersonMarkupEP   = ($epData['ep_extra_person_markup'] ?? 0) * $nights;

                    // ✅ CP: With Breakfast
                    $cpData = calculateExtraPersonPrice($ratePlan, $totalGest, $stayGuest, $roomCount, 'cp');
                    $extraPersonAmountCP   = ($cpData['cp_average_extra_person_price'] ?? 0) * $nights;
                    $extraPersonCostCP     = ($cpData['cp_extra_person_price'] ?? 0) * $nights;
                    $extraPersonMarkupCP   = ($cpData['cp_extra_person_markup'] ?? 0) * $nights;

                    // ✅ MAP: With Breakfast + Dinner
                    $mapData = calculateExtraPersonPrice($ratePlan, $totalGest, $stayGuest, $roomCount, 'map');
                    $extraPersonAmountMAP  = ($mapData['map_average_extra_person_price'] ?? 0) * $nights;
                    $extraPersonCostMAP    = ($mapData['map_extra_person_price'] ?? 0) * $nights;
                    $extraPersonMarkupMAP  = ($mapData['map_extra_person_markup'] ?? 0) * $nights;

                    // ✅ AP: With All Meals
                    $apData = calculateExtraPersonPrice($ratePlan, $totalGest, $stayGuest, $roomCount, 'ap');
                    $extraPersonAmountAP   = ($apData['ap_average_extra_person_price'] ?? 0) * $nights;
                    $extraPersonCostAP     = ($apData['ap_extra_person_price'] ?? 0) * $nights;
                    $extraPersonMarkupAP   = ($apData['ap_extra_person_markup'] ?? 0) * $nights;
                }
            // end  code extra person price


                switch ($category) {
                    case 'Room Only':

                        $extraPersonAmount = $extraPersonAmountEP;
                        $extraPersonCost = $extraPersonCostEP;
                        $extraPersonMarkup = $extraPersonMarkupEP;

                        $totalPrice = $totalAmountEP * $nights;
                        $totalCost = $totalCostEP * $nights;
                        $totalMarkup = $totalMarkupEP * $nights;
                        break;
                    case 'With Breakfast':

                        $extraPersonAmount = $extraPersonAmountCP;
                        $extraPersonCost = $extraPersonCostCP;
                        $extraPersonMarkup = $extraPersonMarkupCP;

                        $totalPrice = $totalAmountCP * $nights;
                        $totalCost = $totalCostCP * $nights;
                        $totalMarkup = $totalMarkupCP * $nights;
                        break;
                    case 'With Breakfast Dinner':

                        $extraPersonAmount = $extraPersonAmountMAP;
                        $extraPersonCost = $extraPersonCostMAP;
                        $extraPersonMarkup = $extraPersonMarkupMAP;

                        $totalPrice = $totalAmountMAP * $nights;
                        $totalCost = $totalCostMAP * $nights;
                        $totalMarkup = $totalMarkupMAP * $nights;
                        break;
                    case 'With Breakfast Lunch Dinner':

                        $extraPersonAmount = $extraPersonAmountAP;
                        $extraPersonCost = $extraPersonCostAP;
                        $extraPersonMarkup = $extraPersonMarkupAP;

                        $totalPrice = $totalAmountAP * $nights;
                        $totalCost = $totalCostAP * $nights;
                        $totalMarkup = $totalMarkupAP * $nights;
                        break;
                }
            }


            // dd($totalPrice * $quantity,$extraPersonAmount);
            $bookedRoomDetails[] = [
                'lead_id'           => $booking->id,
                'room_id'           => $roomId,
                'quantity'          => $quantity,
                'room_category'     => $request->roomTypeId[$key],
                'booking_id'        => $booking->booking_id,
                'break_fast_type'   => $category,
                'total_price'       => ($totalPrice * $quantity) + $extraPersonAmount,
                'vendor_cost'       => ($totalCost * $quantity) + $extraPersonCost,
                'markup'            => ($totalMarkup * $quantity) + $extraPersonMarkup,
                'created_at'        => now(),
                'updated_at'        => now(),
            ];
        }
        // dd($bookedRoomDetails);
        DB::table('booked_room_details')->insert($bookedRoomDetails);
        return $booking->booking_id;
    }


    public function updateBookingStatus(Request $request)
    {
        $bookingDetails = Booking::where('booking_id', $request->booking_id)->first();

        $oldData = [
            'status' => $bookingDetails->status,
        ];

        $bookingDetails->status = $request->status;
        $bookingDetails->save();

        $newData = [
            'status' => $bookingDetails->status,
        ];

        $remark = 'Status Changed';
        LeadRemarkLogger::logChanges($oldData, $newData, $bookingDetails->id, "remark", $remark, true);

        return $bookingDetails;
    }

    public function cancelBookingStatus(Request $request)
    {
        $bookingDetails = Booking::where('booking_id', $request->booking_id)->first();
        $bookingDetails->status = 'cancelled';
        return $bookingDetails->save();
    }
}
