<?php

namespace App\Http\Controllers;

use App\DataTables\RoomAvailabilityDataTable;
use App\Http\Requests\RatePlansRequest;
use App\Models\RatePlan;
use App\Models\Room;
use App\Repositories\RoomAvailabilityRepository;
use Exception;

class RoomAvailabilityController extends Controller
{
    //
    public function __construct(private RoomAvailabilityRepository $roomAvailabilityRepository) {}

    public function index(RoomAvailabilityDataTable $dataTable)
    {
        addVendors(['datatable', 'jquery-validate']);
        $title = 'Room Availability';
        return $dataTable->render('roomavailability.index', compact('title'));
    }

    public function create($roomId, $ratePlanId = null)
    {
        $room = Room::findOrFail(decode($roomId));
        $ratePlan = RatePlan::findOrNew(decode($ratePlanId));
        $html = view('roomavailability.create', compact('room', 'ratePlan'))->render();
        return response()->json(['success' => '200', 'html' => $html]);
    }

    public function store(RatePlansRequest $request)
    {
        try {
            $ratePlanId = decode($request->rate_plan_id);
            $ratePlan = RatePlan::findOrNew($ratePlanId);
            $ratePlan->b2b_rate_ep            = $request->b2b_rate_ep;
            $ratePlan->b2b_rate_cp            = $request->b2b_rate_cp;
            $ratePlan->b2b_rate_map           = $request->b2b_rate_map;
            $ratePlan->markup_ep              = $request->markup_ep;
            $ratePlan->markup_cp              = $request->markup_cp;
            $ratePlan->markup_map             = $request->markup_map;
            $ratePlan->total_amount_ep        = $request->b2b_rate_ep + ($request->markup_ep ?? 0);
            $ratePlan->total_amount_cp        = $request->b2b_rate_cp + ($request->markup_cp ?? 0);
            $ratePlan->total_amount_map       = $request->b2b_rate_map + ($request->markup_map ?? 0);
            $ratePlan->non_refundable_rate    = $request->non_refundable_rate;
            $ratePlan->room_type              = decode($request->room_type);
            $ratePlan->hotel_id               = decode($request->hotel_id);
            $ratePlan->weekly_rate            = $request->weekly_rate;
            $ratePlan->pricing_date           = date('Y-m-d');
            $ratePlan->availability           = $request->availability;
            $ratePlan->year                   = date('Y');
            $ratePlan->month                  = date('m');
            $ratePlan->status                 = 'active';
            $ratePlan->save();

            return response()->json(['status' => 200, 'message' => 'Rate Plan & Availability updated successfully', 'redirect' => route('rooms', encode($ratePlan->hotel_id))], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }
}
