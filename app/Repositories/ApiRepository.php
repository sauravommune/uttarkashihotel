<?php

namespace App\Repositories;
use App\Models\Hotel;
use Carbon\Carbon;

class ApiRepository extends BaseRepository
{

    public function popularHotel()
    {
        $date = Carbon::now()->addDay(2)->format('Y-m-d');  // This is correct

        $popularHotel = Hotel::whereHas('room', function ($query) use ($date) {
            $query->where('status', 1);
        })->whereHas('room.plan',function($query) use ($date){
            $query->whereDate('pricing_date','=',$date)
                ->where('b2b_rate_ep','>',0)
                ->where('availability', '>', 0);
        })
        ->with([
            'room',
            'room.plan' => function ($query) use ($date) {
                $query->whereDate('pricing_date','=',$date)
                    ->where('availability', '>', 0)
                    ->where('b2b_rate_ep','>',0);
            },
        ])
        ->where('status', 'active')
        ->where('papular', 1)
        ->paginate(10);
    
        return $popularHotel;
    }

    
}
