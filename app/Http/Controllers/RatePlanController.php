<?php

namespace App\Http\Controllers;

use App\Http\Requests\RatePlansRequest;
use App\Models\{RatePlan, RatePlanConfig, Room};
use App\Repositories\{RoomRepository, HotelRepository, RatePlansRepository};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Log;

class RatePlanController extends Controller
{
    public function __construct(private RoomRepository $roomRepository, private RatePlansRepository $ratePlansRepository, private HotelRepository $hotelRepository) {}

    public function index()
    {
        $title = 'Rate Plan';
        $hotels = $this->roomRepository->getHotel();
        $ratePlanSearch = session()->get('ratePlanSearch');
        $roomTypes = array();
        if ($ratePlanSearch) {
            $roomTypes = Room::select('id', 'room_type')->with(['roomType:id,name'])->where('hotel_id', $ratePlanSearch['hotel_id'])->get();
        }
        addVendors(['calender', 'jquery-validate']);
        return view('rateplans.index', compact('title', 'hotels', 'roomTypes', 'ratePlanSearch'));
    }


    public function create($roomId = null)
    {
        addVendors(['jquery-validate']);

        if ($roomId) {
            $room_id = decode($roomId);
            $roomDetails = Room::select('id', 'hotel_id', 'room_type', 'total_room')->with(['hotel'])->find($room_id);
        } else {
            $roomDetails = new Room();
        }
        $title = 'Rate Plan';
        $hotel = $this->roomRepository->getHotel();
        $roomsType = Room::select('id', 'hotel_id', 'room_type')->with('roomType')->where('hotel_id', $roomDetails?->hotel_id)->get();

        // Combine the data into one array
        return view('rateplans.add', [
            'title' => $title,
            'roomDetails' => $roomDetails,
            'hotel' => $hotel,
            'roomsType' => $roomsType,
            'roomType' => $roomsType
        ]);
    }

    public function margin($ratePlan)
    {
        addVendors(['jquery-validate']);
        $title = 'Update Margin';
        $ratePlan = RatePlan::find($ratePlan);
        return view('rateplans.add_margin', [
            'title' => $title,
            'ratePlan' => $ratePlan
        ]);
    }

    public function store(RatePlansRequest $request)
    {
        try {
            $this->ratePlansRepository->savePlans($request);
            return response()->json(['status' => 200, 'message' => 'Details Saved Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateStatus()
    {
        try {
            $this->ratePlansRepository->changeStatus();
            return response()->json(['status' => 200, 'message' => 'Update Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateMargin(Request $request)
    {
        try {
            $this->ratePlansRepository->updateMargin($request);
            return response()->json(['status' => 200, 'message' => 'Update Successfully'], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }
    public function destroy()
    {
        try {
            $this->ratePlansRepository->remove();
            return response()->json(['status' => 200, 'message' => 'Rate Plan Removed Successfully', 'redirect' => url()->previous()], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function roomType(Request $request)
    {
        try {
            $roomType = $this->hotelRepository->hotelRooms();
            $option = '<option value = ""></option>';
            foreach ($roomType as $type) {
                $option .= "<option value='" . $type?->id . "'>" . ucwords($type?->roomType?->name) . "</option>";
            }
            return response()->json(['status' => 200, 'data' => $option], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()], 500);
        }
    }

    public function showExtraBedModel($ratePlan)
    {

        $msg = $ratePlan->RatePlanConfig->count() > 0 ? 'Show Extra Bed Price' : 'Add Extra Bed Price';
        $baseUrl = route('show.extra.bed', encode($ratePlan->id));
        $addExtraBedButton = '<a href="' . $baseUrl . '" 
        class="open-extra-bed-modal mt-1 remove-disc d-flex align-items-center badge bg-success-custom"
        data-bs-toggle="modal"
        data-bs-target="#global_modal"
        data-bs-whatever="Extra Bed Price"
        title="View Extra Bed Price">
        <span class="material-symbols-outlined fs-5 pe-2">bed</span>' . $msg . '
        </a>';
        return $addExtraBedButton;
    }


    public function calendarEvents(Request $request)
    {
        $request->session()->put('ratePlanSearch', $request->all());

        $startDate = Carbon::parse($request->start)->format('Y-m-d');
        $endDate = Carbon::parse($request->end)->format('Y-m-d');
        $ratePlans = $this->ratePlansRepository->getRatePlans($startDate, $endDate, $request->hotel_id, $request->roomType);

        $events = [];

        $rateTypes = ['EP' => 1, 'CP' => 2, 'MAP' => 3];

        foreach ($ratePlans as $ratePlan) {

            $showExtraBedModel = $this->showExtraBedModel($ratePlan);

            foreach ($rateTypes as $type => $sortOrder) {
                $rate = match ($type) {
                    'EP'            => $ratePlan->total_amount_ep,
                    'CP'            => $ratePlan->total_amount_cp,
                    'MAP'           => $ratePlan->total_amount_map,
                };

                $events[] = [
                    'title' => "$type: ₹ $rate",
                    'start' => $ratePlan->pricing_date,
                    'end' => null,
                    'display' => 'list-item',
                    'extendedProps' => [
                        'id' => $ratePlan->id,
                        'total_amount_ep' => $ratePlan->total_amount_ep,
                        'total_amount_cp' => $ratePlan->total_amount_cp,
                        'total_amount_map' => $ratePlan->total_amount_map,
                        'sortOrder' => $sortOrder,
                    ],
                ];
            }
            $events[] = [
                'title' => "Availability: $ratePlan->availability",
                'start' => $ratePlan->pricing_date,
                'end' => null,
                'display' => 'list-item',
                'extendedProps' => [
                    'id' => $ratePlan->id,
                    'total_amount_ep' => $ratePlan->total_amount_ep,
                    'total_amount_cp' => $ratePlan->total_amount_cp,
                    'total_amount_map' => $ratePlan->total_amount_map,
                    'sortOrder' => 4,

                ],
            ];

            $events[] = [
                'start' => $ratePlan->pricing_date,
                'end' => null,
                'display' => 'list-item',
                'extendedProps' => [
                    'id' => $ratePlan->id,
                    'extra_bed_btn' => $showExtraBedModel,
                    'sortOrder' => 999,
                ],
            ];
        }
        return response()->json(['status' => 200, 'events' => $events, 'hotelId' => encode($request->hotel_id), 'roomType' => encode($request->roomType)], 200);
    }

    public function edit(Request $request)
    {
        if ($request->ratePlan) {
            $ratePlan = RatePlan::findOrFail($request->ratePlan);
            $hotelId = $ratePlan->hotel_id;
            $roomType = $ratePlan->room_type;
            $pricingDate = $ratePlan->pricing_date;
        } else {
            $pricingDate = Carbon::parse($request->selectedEventDate)->format('Y-m-d');
            $hotelId = $request->selectedHotel;
            $roomType = $request->selectedRoom;
            $pricingDate = $pricingDate;
            $ratePlan = RatePlan::where('hotel_id', $hotelId)
                ->where('room_type', $roomType)
                ->where('pricing_date', $pricingDate)
                ->firstOrNew();
        }
        $html =  view('rateplans.edit', compact('ratePlan', 'hotelId', 'roomType', 'pricingDate'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function update(RatePlansRequest $request, RatePlan $ratePlan)
    {
        $ratePlan = RatePlan::where('hotel_id', $request->hotel_id)->where('room_type', $request->room_type)->where('pricing_date', $request->pricing_date)->firstOrNew();
        $ratePlan->hotel_id             = $request->hotel_id;
        $ratePlan->room_type            = $request->room_type;
        $ratePlan->pricing_date         = $request->pricing_date;
        $ratePlan->b2b_rate_ep          = $request->b2b_rate_ep;
        $ratePlan->b2b_rate_cp          = $request->b2b_rate_cp;
        $ratePlan->b2b_rate_map         = $request->b2b_rate_map;
        $ratePlan->markup_ep            = $request->markup_ep;
        $ratePlan->markup_cp            = $request->markup_cp;
        $ratePlan->markup_map           = $request->markup_map;
        $ratePlan->total_amount_ep      = $request->b2b_rate_ep + ($request->markup_ep ?? 0);
        $ratePlan->total_amount_cp      = $request->b2b_rate_cp + ($request->markup_cp ?? 0);
        $ratePlan->total_amount_map     = $request->b2b_rate_map + ($request->markup_map ?? 0);
        $ratePlan->non_refundable_rate  = $request->non_refundable_rate;
        $ratePlan->weekly_rate          = $request->weekly_rate;
        $ratePlan->availability         = $request->availability ?? 0;
        $ratePlan->status               = 'active';
        $ratePlan->save();
        return response()->json(['status' => 200, 'message' => 'Rate Plan Saved Successfully!'], 200);
    }


    public function extraBed(Request $request)
    {
        $hotelId = decode($request->hotelId);
        $roomType = decode($request->roomType);
        $html =  view('rateplans.edit_extra_bed_price', compact('hotelId', 'roomType'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function showExtraBed(Request $request)
    {
        $planId = decode($request->planId);
        $ratePlan = RatePlan::find($planId);
        $html =  view('rateplans.show_extra_bed', compact('ratePlan'))->render();
        return response()->json(['success' => 200, 'html' => $html]);
    }

    public function extraBedPriceUpdate(Request $request)
    {

        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        try {
            // Fetch rate plans by hotel_id and room_type
            $ratePlans = RatePlan::where('hotel_id', $request->hotel_id)->where('room_type', $request->room_type)->whereBetween('pricing_date', [$request->start_date, $request->end_date])->get();
            if ($ratePlans->isEmpty()) {
                return response()->json(['status' => 404, 'message' => 'Rate plan not found'], 404);
            }

            $hasExtraConfig = $request->is_extra_person_allowed == 'on' || $request->child_with_bed == 'on' || $request->child_with_no_bed == 'on';

            if (!$hasExtraConfig) {
                return response()->json(['status' => 422, 'message' => 'No extra bed configuration selected'], 422);
            }

            // Define available plan types
            $planTypes = ['ep', 'cp', 'map'];

            foreach ($ratePlans as $ratePlan) {
                // Update base rate plan flags
                $ratePlan->update([
                    'is_extra_person_allowed' => $request->is_extra_person_allowed == 'on' ? 1 : 0,
                    'no_of_extra_person'      => $request->no_of_extra_person ?? 0,
                    'child_with_bed'          => $request->child_with_bed == 'on' ? 1 : 0,
                    'min_child_age'           => $request->min_child_age ?? 0,
                    'child_with_no_bed'       => $request->child_with_no_bed == 'on' ? 1 : 0,
                ]);

                // Update or create RatePlanConfig entries
                foreach ($planTypes as $planType) {
                    RatePlanConfig::updateOrCreate(
                        [
                            'rate_plan_id' => $ratePlan->id,
                            'plan_type'    => $planType,
                        ],
                        [
                            'extra_person_price'        => $request->extra_person_price[$planType] ?? 0,
                            'extra_person_markup'       => $request->extra_person_markup[$planType] ?? 0,
                            'child_with_bed_price'      => $request->child_with_bed_price[$planType] ?? 0,
                            'child_with_bed_markup'     => $request->child_with_bed_markup[$planType] ?? 0,
                            'child_with_no_bed_price'   => $request->child_with_no_bed_price[$planType] ?? 0,
                            'child_with_no_bed_markup'  => $request->child_with_no_bed_markup[$planType] ?? 0,
                        ]
                    );
                }
            }

            return response()->json([
                'status' => 200,
                'message' => 'Extra bed pricing added successfully',
                'redirect' => url('rate-plan/index')
            ], 200);
        } catch (\Exception $e) {
            Log::error('Extra Bed Update Failed: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' =>  $e->getMessage(),
            ], 500);
        }
    }

    public function singleExtraBedPriceUpdate(Request $request)
    {

        try {
            $ratePlan = RatePlan::find($request->planId);

            if (!$ratePlan) {
                return response()->json(['status' => 404, 'message' => 'Rate plan not found'], 404);
            }

            // Update all related rate plans for the same hotel and room_type
            $ratePlan->update([
                'is_extra_person_allowed' => $request->is_extra_person_allowed == 'on' ? 1 : 0,
                'no_of_extra_person'      => $request->no_of_extra_person ?? 0,
                'child_with_bed'          => $request->child_with_bed == 'on' ? 1 : 0,
                'min_child_age'           => $request->min_child_age ?? 0,
                'child_with_no_bed'       => $request->child_with_no_bed == 'on' ? 1 : 0,
            ]);
            $plans = ['ep', 'cp', 'map'];
            foreach ($plans as $plan) {

                RatePlanConfig::updateOrCreate(
                    [
                        'rate_plan_id' => $ratePlan->id,
                        'plan_type'    => $plan,
                    ],
                    [
                        'extra_person_price'        => $request->extra_person_price[$plan] ?? 0,
                        'extra_person_markup'       => $request->extra_person_markup[$plan] ?? 0,
                        'child_with_bed_price'      => $request->child_with_bed_price[$plan] ?? 0,
                        'child_with_bed_markup'     => $request->child_with_bed_markup[$plan] ?? 0,
                        'child_with_no_bed_price'   => $request->child_with_no_bed_price[$plan] ?? 0,
                        'child_with_no_bed_markup'  => $request->child_with_no_bed_markup[$plan] ?? 0,
                    ]
                );
            }

            return response()->json(['status' => 200, 'message' => 'Extra bed pricing updated successfully', 'redirect' => url('rate-plan/index')], 200);
        } catch (\Exception $e) {
            Log::error('Extra Bed Update Failed: ' . $e->getMessage());

            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while updating the extra bed configuration.'
            ], 500);
        }
    }
}
