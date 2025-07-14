<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\LeadDataTable;
use App\DataTables\SearchLeadsDataTable;
use App\Models\{Booking, City, RatePlan, BookedRoomDetails, BookingRemarks, Room, RecommendHotel, LeadEmployee};
use App\Repositories\{BookingRemarkRepository, BookingRepository, ChangeHotelRepository, PaymentRepository, MailRepository};
use App\Services\LeadRemarkLogger;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LeadController extends Controller
{
    public function index(LeadDataTable $dataTable)
    {

        $title = "Booking Leads";
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);

        $cities = City::all();
        return $dataTable->render('lead.index', compact('title', 'cities'));
    }

    public function currentAssignedLeads()
    {
        $currentAssignedLeads = LeadEmployee::select('id', 'booking_id')->with(['booking:id,booking_id'])->whereNull('completed_at')->where('user_id', auth()->user()->id)->get()->map(fn($lead) => $lead->booking?->booking_id)
            ->filter()
            ->implode(', ');
        if ($currentAssignedLeads) {
            $currentAssignedLeads = '<strong>Current Assigned Leads: </strong>' . $currentAssignedLeads;
        } else {
            $currentAssignedLeads = '<strong>Current Assigned Leads: </strong> N/A';
        }
        return response()->json(['currentAssignedLeads' => $currentAssignedLeads]);
    }

    public function leadDetail($bookingId)
    {
        $title = "Booking Details";
        $bookingDetails = Booking::with([
            'travelers',
            'contactInfo',
            'payments',
            'bookedRooms',
            'transactions',
            'vendorStatus',
            'coupon'
        ])->where('booking_id', $bookingId)->firstOrFail();
        $data = [
            'title'             => $title,
            'bookingDetails'    => $bookingDetails,
            'travelers'         => $bookingDetails?->travelers,
            'contactInfo'       => $bookingDetails?->contactInfo,
            'paymentDetails'    => $bookingDetails?->payments,
            'transactions'      => $bookingDetails?->transactions,
            'roomDetails'       => $bookingDetails?->bookedRooms,
            'bookingRemarks'    => $bookingDetails?->remarks->groupBy('remark_type'),
        ];

        addVendors(['datatable', 'tinyMCE', 'jquery-validate', 'select2', 'front-flatpicker', 'change_hotel']);
        return view('lead.lead-detail', $data);
    }

    public function search(SearchLeadsDataTable $dataTable)
    {
        $title = "Lead";
        addVendors(['datatable', 'tinyMCE', 'jquery-validate']);
        return $dataTable->render('lead.search', compact('title'));
    }

    public function saveRemarks(Request $request, BookingRemarkRepository $repository)
    {
        $request->validate([
            'remark'        => 'required',
            'remark_type'   => 'required'
        ]);

        try {
            if ($repository->saveRemarks($request)) {
                return response()->json(['status' => 200, 'message' => 'Update Successfully', 'redirect' => url()->previous()], 200);
            }
        } catch (Exception $e) {
            Log::error('Booking Remark Error: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Unable to update'], 500);
        }
    }

    public function changeBookingDate($bookingId)
    {
        $bookingDetails = Booking::where('booking_id', $bookingId)->first();
        $html = view('lead.model.booking-date-change', compact('bookingDetails'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function changeBookingStatus($bookingId)
    {
        $bookingDetails = Booking::where('booking_id', $bookingId)->first();
        $html = view('lead.model.change-booking-status', compact('bookingDetails'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function saveBookingStatus(Request $request, BookingRepository $repository)
    {
        $request->validate(['status' => 'required']);

        try {
            if ($repository->updateBookingStatus($request)) {
                return response()->json(['status' => 200, 'message' => 'Update Successfully', 'redirect' => url()->previous()], 200);
            }
        } catch (Exception $e) {
            Log::error('Booking Status Error: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Unable to update'], 500);
        }
    }

    public function cancelBooking($booking)
    {
        $html = view('lead.model.cancel-booking', compact('booking'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function cancelBookingSave(Request $request, BookingRepository $repository)
    {
        try {
            if ($repository->cancelBookingStatus($request)) {
                return response()->json(['status' => 200, 'message' => 'Update Successfully', 'redirect' => url()->previous()], 200);
            }
        } catch (Exception $e) {
            Log::error('Booking Status Error: ' . $e->getMessage());
            return response()->json(['status' => false, 'message' => 'Unable to update'], 500);
        }
    }

    //change hotel

    public function changeHotel(Request $request, $booking, ChangeHotelRepository $repository)
    {
        $bookingDetails = Booking::where('booking_id', $booking)->first();
        $searchParams = [
            'city'          => $bookingDetails?->hotel?->city,
            'adult'         => $bookingDetails?->adult,
            'child'         => $bookingDetails?->child,
            'check_in'      => $bookingDetails?->check_in_date,
            'check_out'     => $bookingDetails?->check_out_date,
            'roomCount'     => $bookingDetails?->total_room,
            'currentHotel'  => $bookingDetails?->hotel_id,
        ];

        $searchResult = $repository->LeadHotelSearch($searchParams, $request);
        $view = $request->hotel_name ? 'lead.model.hotel-box' : 'lead.model.change-hotel';
        $html = view($view, compact('bookingDetails', 'searchResult'))->render();

        return response()->json(['success' => 200, 'html' => $html]);
    }


    public function recommendHotel(Request $request, $booking, ChangeHotelRepository $repository)
    {
        $bookingDetails = Booking::where('booking_id', $booking)->first();
        $searchParams = [
            'city'          => $bookingDetails?->hotel?->city,
            'adult'         => $bookingDetails?->adult,
            'child'         => $bookingDetails?->child,
            'check_in'      => $bookingDetails?->check_in_date,
            'check_out'     => $bookingDetails?->check_out_date,
            'roomCount'     => $bookingDetails?->total_room,
            'currentHotel'  => $bookingDetails?->hotel_id,
        ];


        $recommendHotel = RecommendHotel::where('user_id', $bookingDetails->user_id)->get(['hotel_id', 'user_id', 'status']);
        $searchResult = $repository->LeadHotelSearch($searchParams, $request);

        if ($request->type == 'filter') {

            $tableBodyHtml = view('lead.model.recommend-hotel-table', compact('bookingDetails', 'searchResult', 'recommendHotel'))->render();
            return response()->json(['success' => 200, 'html' => $tableBodyHtml]);
        } else {
            $html = view('lead.model.recommend-hotel', compact('bookingDetails', 'searchResult', 'recommendHotel'))->render();
            return response()->json(['success' => 200, 'html' => $html]);
        }
    }

    public function savedRecommendHotel(Request $request, MailRepository $mailRepository)
    {


        $bookingId = $request->bookingId;

        try {

            $hotel_id = $request->hotel_id;

            if (!empty($hotel_id)) {
                foreach ($hotel_id as $key => $val) {

                    RecommendHotel::updateOrCreate(
                        [
                            'hotel_id' => (int)$val,
                            'user_id' => (int)$request->user_id[$key],
                        ],
                        [
                            'status' => (int)$request->status[$key],
                        ]
                    );
                }
                $user_id  = $request->user_id['0'];
                $sendMail  = $mailRepository->sendMailRecommendHotel($user_id, $bookingId);

                if ($sendMail == "no_mail") {
                    return response()->json(['status' => 200, 'message' => 'Recommend hotel Removed Successfully', 'redirect' => url()->previous()], 200);
                } else {
                    return response()->json(['status' => 200, 'message' => 'Recommend hotel saved and send user email', 'redirect' => url()->previous()], 200);
                }
            } else {
                return response()->json(['status' => 200, 'message' => 'Recommend hotel not saved', 'redirect' => url()->previous()], 200);
            }
        } catch (Exception $e) {
            Log::info('Recommended Hotel status');
            Log::info($e->getMessage());
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }



    public function hotelRooms(Request $request, ChangeHotelRepository $repository)
    {
        $roomDetails = $repository->HotelRooms($request);
        return view('lead.model.change-room', compact('roomDetails'));
    }

    public function getRatePlans(Request $request)
    {
        $bookingId  = $request->bookingID;
        $checkin    = $request->check_in;
        $checkout   = $request->check_out;

        $bookingDetails = Booking::where('booking_id', $bookingId)->latest()->first();

        if (!$bookingDetails) {
            return response()->json(['status' => 400, 'message' => 'Booking details not found.']);
        }

        $bookedRooms = $bookingDetails->bookedRooms;
        $hotelId = $bookingDetails->hotel_id;

        $quantitiesByRoom = $bookedRooms->groupBy('room_id')->map(fn($group, $roomId) => [
            'room_id'   => $roomId,
            'quantity'  => $group->sum('quantity'),
        ]);

        $bookedRoomDetails = $bookedRooms->map(fn($room) => [
            'room_id'           => $room->room_id,
            'quantity'          => $room->quantity,
            'break_fast_type'   => $room->break_fast_type,
        ])->toArray();

        $ratePlans = RatePlan::where('hotel_id', $hotelId)
            ->whereBetween('pricing_date', [$checkin, $checkout])
            ->where(function ($query) use ($quantitiesByRoom) {
                foreach ($quantitiesByRoom as $roomData) {
                    $query->orWhere(fn($subQuery) => $subQuery
                        ->where('room_type', $roomData['room_id'])
                        ->where('availability', '>=', $roomData['quantity']));
                }
            })
            ->get();

        if ($ratePlans->isEmpty()) {
            return response()->json(['status' => 400, 'message' => 'Room is not available. Please choose another date.']);
        }

        $totals = [
            'ep'    => ['amount' => 0, 'cost' => 0, 'markup' => 0],
            'cp'    => ['amount' => 0, 'cost' => 0, 'markup' => 0],
            'map'   => ['amount' => 0, 'cost' => 0, 'markup' => 0],
        ];

        foreach ($bookedRoomDetails as $type) {
            foreach ($ratePlans as $plan) {
                if ($plan->room_type === $type['room_id']) {
                    $quantity = $type['quantity'];

                    switch ($type['break_fast_type']) {
                        case 'Room Only':
                            $totals['ep']['amount'] += $plan->total_amount_ep * $quantity;
                            $totals['ep']['cost']   += $plan->b2b_rate_ep * $quantity;
                            $totals['ep']['markup'] += $plan->markup_ep * $quantity;
                            break;

                        case 'With Breakfast':
                            $totals['cp']['amount'] += $plan->total_amount_cp * $quantity;
                            $totals['cp']['cost']   += $plan->b2b_rate_cp * $quantity;
                            $totals['cp']['markup'] += $plan->markup_cp * $quantity;
                            break;

                        case 'With Breakfast Dinner':
                            $totals['map']['amount']    += $plan->total_amount_map * $quantity;
                            $totals['map']['cost']      += $plan->b2b_rate_map * $quantity;
                            $totals['map']['markup']    += $plan->markup_map * $quantity;
                            break;
                    }
                }
            }
        }

        $newTotalAmount = $totals['ep']['amount'] + $totals['cp']['amount'] + $totals['map']['amount'];
        $newTotalCost   = $totals['ep']['cost'] + $totals['cp']['cost'] + $totals['map']['cost'];
        $newTotalMarkup = $totals['ep']['markup'] + $totals['cp']['markup'] + $totals['map']['markup'];

        $payAmount = $newTotalAmount - $request->previous_amount;

        if ($payAmount > 0) {
            return response()->json([
                'status'            => 200,
                'text'              => 'Payable Amount',
                'message'           => 'Room is Available. You can change the date.',
                'total_new_amount'  => $newTotalAmount,
                'payAmount'         => $payAmount,
            ]);
        } elseif ($payAmount === 0) {
            return response()->json([
                'status'            => 200,
                'message'           => 'Please change check-in and checkout date.',
                'total_new_amount'  => $newTotalAmount,
                'payAmount'         => $payAmount,
            ]);
        } else {
            return response()->json([
                'status'            => 201,
                'text'              => 'Refundable Amount',
                'message'           => 'Room is Available. You can change the date.',
                'total_new_amount'  => $newTotalAmount,
                'payAmount'         => abs($payAmount),
            ]);
        }
    }

    public function updateBookingDate(Request $request, PaymentRepository $paymentRepository)
    {
        $check_in = $request->check_in;
        $check_out = $request->check_out;

        // Check if either the check-in or check-out date has changed
        if ($request->previous_check_in_date === $check_in && $request->previous_check_out_date === $check_out) {
            return response()->json(['status' => 200, 'message' => 'No changes to the booking dates.'], 400);
        }

        try {

            // Ensure booked room details exist
            if (empty($request->booked_room_details)) {
                return response()->json(['status' => 400, 'error' => 'No booked room details provided.'], 400);
            }

            // Calculate previous and new stay nights
            $previous_stay_nights = max((int)stayNights($request->previous_check_in_date, $request->previous_check_out_date), 1);
            $stay_nights = max((int)stayNights($check_in, $check_out), 1);

            $booking = Booking::where('booking_id', $request->booking_id)->firstOrFail();
            // Update booking dates
            $booking->update([
                'check_in_date' => $check_in,
                'check_out_date' => $check_out,
            ]);

            foreach ($request->booked_room_details as $room) {
                $booked_room = json_decode($room, true);

                // Calculate updated prices
                $scaling_factor = $stay_nights / $previous_stay_nights;
                $total_price    = $booked_room['total_price'] * $scaling_factor;
                $vendor_cost    = $booked_room['vendor_cost'] * $scaling_factor;
                $markup         = $booked_room['markup'] * $scaling_factor;

                // Update room details
                BookedRoomDetails::where('id', $booked_room['id'])->update([
                    'total_price'   => $total_price,
                    'vendor_cost'   => $vendor_cost,
                    'markup'        => $markup,
                ]);
            }

            // Update payment information
            $paymentRepository->updateAmount($request->booking_id);

            $oldData = [
                'check_in_date' => $request->previous_check_in_date,
                'check_out_date' => $request->previous_check_out_date,
            ];
            $newData = [
                'check_in_date' => $check_in,
                'check_out_date' => $check_out,
            ];

            $remark = 'Date Changed';
            LeadRemarkLogger::logChanges($oldData, $newData, $booking->id, "remark", $remark, true);

            return response()->json([
                'status'    => 200,
                'message'   => 'Booking dates updated successfully.',
                'redirect'  => $request->booking_id,
            ], 200);
        } catch (\Exception $e) {
            Log::error('Error updating booking details: ', [
                'message'   => $e->getMessage(),
                'trace'     => $e->getTraceAsString(),
            ]);
            return response()->json([
                'status'    => 500,
                'error'     => 'An error occurred while updating booking details.',
            ], 500);
        }
    }

    public function changeRoomHotel(Request $request, PaymentRepository $paymentRepository)
    {
        $validatedData = $request->validate([
            'booking_id'   => 'required|string|exists:bookings,booking_id',
            'hotelId'      => 'required|integer|exists:hotels,id',
            'roomId'       => 'required|array',
            'roomTypeId'   => 'required|array',
            'breakFastType' => 'required|array',
            'quantity'     => 'required|array',
        ]);

        if (collect($validatedData['quantity'])->sum() <= 0) {
            return response()->json(['error' => 'Invalid room quantity'], 400);
        }

        try {
            $oldData = $newData = [];

            DB::beginTransaction();

            $booking = Booking::where('booking_id', $validatedData['booking_id'])->firstOrFail();

            $oldData['hotel'] = $booking->hotel->name;
            foreach ($booking->bookedRooms as $key => $room) {
                $oldData['rooms_' . $key] = $room?->quantity . ' X ' . $room?->roomCategory->name . ' (' . $room?->plan_name . ')';
            }

            $booking->update(['hotel_id' => (int) $validatedData['hotelId']]);
            // Delete previous room details
            BookedRoomDetails::where('booking_id', $booking->booking_id)->delete();

            // Calculate nights
            $nights = Carbon::parse($booking->check_in_date)->diffInDays(Carbon::parse($booking->check_out_date));

            $bookedRoomDetails = collect($validatedData['roomId'])->map(function ($roomId, $key) use ($validatedData, $nights, $booking) {
                return $this->prepareRoomDetails($roomId, $key, $validatedData, $nights, $booking);
            })->toArray();

            DB::table('booked_room_details')->insert($bookedRoomDetails);

            $paymentRepository->updateAmount($booking->booking_id);

            $booking->refresh();
            $newData['hotel'] = $booking->hotel->name;
            foreach ($booking->bookedRooms as $key => $room) {
                $newData['rooms_' . $key] = $room?->quantity . ' X ' . $room?->roomCategory->name . ' (' . $room?->plan_name . ')';
            }

            DB::commit();

            $remark = 'Hotel/Room Changed';
            LeadRemarkLogger::logChanges($oldData, $newData, $booking->id, "remark", $remark, true);

            return response()->json([
                'status'  => 200,
                'message' => 'Room change successful.',
                'redirect' => $booking->booking_id,
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Booking Error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'An error occurred while processing your request'], 500);
        }
    }

    private function prepareRoomDetails($roomId, $key, $validatedData, $nights, $booking)
    {
        $roomDetails = Room::with(['ratePlan' => function ($query) use ($booking) {
            $query->whereBetween('pricing_date', [$booking->check_in_date, $booking->check_out_date]);
        }])->find($roomId);

        $breakFastType = $validatedData['breakFastType'][$key];
        $ratePlanSummary = $this->calculateRatePlanSummary($roomDetails, $breakFastType, $nights);

        return [
            'lead_id'        => $booking->id,
            'room_id'        => $roomId,
            'quantity'       => $validatedData['quantity'][$key],
            'room_category'  => $validatedData['roomTypeId'][$key],
            'booking_id'     => $booking->booking_id,
            'break_fast_type' => $breakFastType,
            'total_price'    => $ratePlanSummary['totalPrice'] * $validatedData['quantity'][$key],
            'vendor_cost'    => $ratePlanSummary['totalCost'] * $validatedData['quantity'][$key],
            'markup'         => $ratePlanSummary['totalMarkup'] * $validatedData['quantity'][$key],
            'created_at'     => now(),
            'updated_at'     => now(),
        ];
    }

    private function calculateRatePlanSummary($roomDetails, $breakFastType, $nights)
    {
        $totalPrice = $totalCost = $totalMarkup = 0;

        if ($roomDetails && $roomDetails->ratePlan->isNotEmpty()) {
            $ratePlanCount = $roomDetails->ratePlan->count();
            $rates = [
                'Room Only' => [
                    'amount' => $roomDetails->ratePlan->sum('total_amount_ep') / $ratePlanCount,
                    'cost'   => $roomDetails->ratePlan->sum('b2b_rate_ep') / $ratePlanCount,
                    'markup' => $roomDetails->ratePlan->sum('markup_ep') / $ratePlanCount,
                ],
                'With Breakfast' => [
                    'amount' => $roomDetails->ratePlan->sum('total_amount_cp') / $ratePlanCount,
                    'cost'   => $roomDetails->ratePlan->sum('b2b_rate_cp') / $ratePlanCount,
                    'markup' => $roomDetails->ratePlan->sum('markup_cp') / $ratePlanCount,
                ],
                'With Breakfast Dinner' => [
                    'amount' => $roomDetails->ratePlan->sum('total_amount_map') / $ratePlanCount,
                    'cost'   => $roomDetails->ratePlan->sum('b2b_rate_map') / $ratePlanCount,
                    'markup' => $roomDetails->ratePlan->sum('markup_map') / $ratePlanCount,
                ],
            ];

            $rate = $rates[$breakFastType] ?? ['amount' => 0, 'cost' => 0, 'markup' => 0];

            $totalPrice = $rate['amount'] * $nights;
            $totalCost = $rate['cost'] * $nights;
            $totalMarkup = $rate['markup'] * $nights;
        }

        return compact('totalPrice', 'totalCost', 'totalMarkup');
    }

    public function delete($bookingId)
    {
        try {
            $decodedBookingId = decode($bookingId);

            // Find the booking or throw a 404 exception if not found
            $booking = Booking::findOrFail($decodedBookingId);

            // Bulk delete related data
            $booking->load([
                'bookingTraveler',
                'bookingContact',
                'transactions',
                'remarks',
                'bookedRooms',
                'bookingEmails',
                'vendorStatus',
            ]);

            // Delete related data using relationships
            $booking->bookingTraveler()->delete();
            $booking->bookingContact()->delete();
            $booking->transactions()->delete();
            $booking->remarks()->delete();
            $booking->bookedRooms()->delete();
            $booking->bookingEmails()->delete();
            $booking->vendorStatus()->delete();

            // Delete the booking itself
            $booking->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Booking deleted successfully',
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => 404,
                'message' => 'Booking not found',
            ], 404);
        } catch (Exception $e) {
            Log::error('Error deleting booking: ', ['message' => $e->getMessage()]);
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while deleting the booking.',
            ], 500);
        }
    }

    public function abandon($bookingId)
    {
        try {
            $decodedBookingId = decode($bookingId);
            $booking = Booking::findOrFail($decodedBookingId);

            $booking->update([
                'status'        => 'abandoned',
                'is_abandoned'  => !$booking->is_abandoned
            ]);
        } catch (Exception $e) {
            Log::error('Error abandon booking: ', ['message' => $e->getMessage()]);
            return response()->json([
                'status' => 404,
                'message' => $e->getMessage(),
            ], 404);
        }
    }

    public function leadEmployee($bookingId)
    {
        $decodedBookingId = decode($bookingId);
        $booking = Booking::with('currentLeadEmployee')->findOrFail($decodedBookingId);
        $currentEmployee = $booking->currentLeadEmployee;

        if ($currentEmployee) {
            $currentUserId = auth()->user()->id;

            // Check if the current user is already assigned
            if ($currentEmployee->user_id === $currentUserId) {
                $assignedAt = Carbon::parse($currentEmployee->assigned_at);

                // Ensure at least 2 minutes have passed to remove themselves
                if ($assignedAt->diffInMinutes(now()) <= 2) {
                    return response()->json([
                        'status' => 422,
                        'message' => 'You can only remove yourself from lead after 2 minutes.',
                    ], 200);
                }

                // Mark the current lead as completed
                $currentEmployee->update(['completed_at' => now()]);

                return response()->json([
                    'status' => 200,
                    'message' => 'You removed yourself from lead.',
                ], 200);
            }

            // Lead is assigned to another employee
            return response()->json([
                'status' => 200,
                'message' => 'Lead is already assigned to another employee.',
            ], 200);
        }

        // Restrict user to a maximum of 2 active leads
        $activeLeadsCount = LeadEmployee::where('user_id', auth()->user()->id)
            ->whereNull('completed_at')
            ->count();

        if ($activeLeadsCount >= 2) {
            return response()->json([
                'status' => 422,
                'message' => 'You can only have 2 leads at a time.',
            ], 200);
        }

        // Assign the current user as lead
        $booking->leadEmployee()->create([
            'booking_id' => $decodedBookingId,
            'user_id' => auth()->user()->id,
            'assigned_at' => now(),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'You are assigned as lead.',
        ], 200);
    }

    public function leadRemarks(Request $request)
    {
        [$userId, $bookingId] = array_map('decode', [$request->userId, $request->bookingId]);

        $bookingDetails = Booking::select('id', 'booking_id')->with(['remarks'])->find($bookingId);

        $remarks = ['important', 'remark', 'payment'];
        $html = collect($remarks)->mapWithKeys(function ($type) use ($userId, $bookingId) {
            return [
                $type => view('components.remark-component', ['remarks' => BookingRemarks::where(['added_by' => $userId, 'booking_id' => $bookingId])
                    ->where('remark_type', $type)->latest()->get()])->render()
            ];
        })->toArray();
        sleep(1);
        return view('lead.remark-canvas', compact('html', 'bookingDetails', 'userId'));
    }
}
