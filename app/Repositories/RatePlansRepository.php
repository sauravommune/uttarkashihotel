<?php

namespace App\Repositories;

use App\Http\Requests\RatePlansRequest;
use App\Models\RatePlan;
use App\Models\RoomCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;



class RatePlansRepository extends BaseRepository
{

    public function __construct(private ?RatePlan $ratePlan, private RoomCategory $roomCategory)
    {
        $this->ratePlan = request('id') ? RatePlan::find(request('id')) : new RatePlan();
    }


    public function savePlans(RatePlansRequest $request)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $request->start_date);
        $endDate = Carbon::createFromFormat('Y-m-d', $request->end_date);
        $daysNumbers = $request->days??[0,1,2,3,4,5,6];
        $plans = ['ep', 'cp', 'map'];

        while ($startDate <= $endDate) {

            if( !in_array($startDate->dayOfWeek, $daysNumbers) ){
                $startDate->addDay();
                continue;
            }

            $attributes = [
                'room_type' => $request->room_type,
                'hotel_id' => $request?->hotel,
                'pricing_date' => $startDate->format('Y-m-d'),
            ];
            $this->ratePlan = RatePlan::firstOrNew($attributes);
            $this->ratePlan->b2b_rate_ep            = $request->b2b_rate_ep;
            $this->ratePlan->b2b_rate_cp            = $request->b2b_rate_cp;
            $this->ratePlan->b2b_rate_map           = $request->b2b_rate_map;
            $this->ratePlan->markup_ep              = $request->markup_ep;
            $this->ratePlan->markup_cp              = $request->markup_cp;
            $this->ratePlan->markup_map             = $request->markup_map;
            $this->ratePlan->total_amount_ep        = $request->b2b_rate_ep + ($request->markup_ep ?? 0);
            $this->ratePlan->total_amount_cp        = $request->b2b_rate_cp + ($request->markup_cp ?? 0);
            $this->ratePlan->total_amount_map       = $request->b2b_rate_map + ($request->markup_map ?? 0);
            $this->ratePlan->non_refundable_rate    = $request->non_refundable_rate;
            $this->ratePlan->margin_updated_on      = $request->margin_updated_on;
            $this->ratePlan->room_type              = $request->room_type;
            $this->ratePlan->hotel_id               = $request->hotel;
            $this->ratePlan->weekly_rate            = $request->weekly_rate;
            $this->ratePlan->pricing_date           = $startDate->format('Y-m-d');
            $this->ratePlan->availability           = $request->availability;
            $this->ratePlan->is_extra_person_allowed = $request->is_extra_person_allowed==='on' ? true : false;
            $this->ratePlan->no_of_extra_person     = $request->no_of_extra_person??0;
            $this->ratePlan->child_with_bed         = $request->child_with_bed==='on' ? true : false;
            $this->ratePlan->min_child_age          = $request->min_child_age??0;
            $this->ratePlan->child_with_no_bed      = $request->child_with_no_bed==='on' ? true : false;
            $this->ratePlan->year                   = $startDate->year;
            $this->ratePlan->month                  = $startDate->month;
            $this->ratePlan->status                 = 'active';
            $this->ratePlan->save();

            
            if( $request->is_extra_person_allowed == 'on' ||  $request->child_with_bed == 'on' || $request->child_with_no_bed == 'on'){
                $this->ratePlan->room->update([
                    'extra_persons' => $request->no_of_extra_person??0
                ]);
                foreach($plans as $plan){
                    $this->ratePlan->RatePlanConfig()->updateOrCreate(
                        [
                            'rate_plan_id'              => $this->ratePlan->id,
                            'plan_type'                 => $plan,
                        ],
                        [
                            'extra_person_price'        => $request->extra_person_price[$plan]??0,
                            'extra_person_markup'       => $request->extra_person_markup[$plan]??0,
                            'child_with_bed_price'      => $request->child_with_bed_price[$plan]??0,
                            'child_with_bed_markup'     => $request->child_with_bed_markup[$plan]??0,
                            'child_with_no_bed_price'   => $request->child_with_no_bed_price[$plan]??0,
                            'child_with_no_bed_markup'  => $request->child_with_no_bed_markup[$plan]??0
                        ]
                    );
                }
            }

            $startDate->addDay();
        }
    }

    public function changeStatus()
    {
        $this->ratePlan->status = $this->ratePlan->status == 'active' ? 'inactive' : 'active';
        return $this->ratePlan->save();
    }

    private function dateWiseRateList($startDate, $endDate) {}

    public function getRoomTypes()
    {
        return $this->roomCategory->whereStatus('active')->get();
    }

    public function updateMargin(Request $request)
    {
        $this->ratePlan->b2b_rate_ep        = $request->b2b_rate_ep;
        $this->ratePlan->b2b_rate_cp        = $request->b2b_rate_cp;
        $this->ratePlan->b2b_rate_map       = $request->b2b_rate_map;
        $this->ratePlan->markup_ep          = $request->markup_ep;
        $this->ratePlan->markup_cp          = $request->markup_cp;
        $this->ratePlan->markup_map         = $request->markup_map;
        $this->ratePlan->total_amount_ep    = $request->b2b_rate_ep + ($request->markup_ep ?? 0);
        $this->ratePlan->total_amount_cp    = $request->b2b_rate_cp + ($request->markup_cp ?? 0);
        $this->ratePlan->total_amount_map   = $request->b2b_rate_map + ($request->markup_map ?? 0);
        $this->ratePlan->status             = 'active';
        $this->ratePlan->save();
    }

    public function remove()
    {
        return $this->ratePlan->delete();
    }

    public function getRatePlans($startDate, $endDate, $hotel, $roomType)
    {
        $query = RatePlan::where('hotel_id', $hotel)
            ->where('room_type', $roomType)
            // ->whereBetween('pricing_date', [$startDate, $endDate])
            ->where('pricing_date', '>=', $startDate)->where('pricing_date', '<', $endDate)

            ->where('status', 'active');
        return $query->get();
    }
}
