<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PopularHotel extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'data' => $this->collection->map(function ($hotel) {
                return [
                    'name' =>  $hotel->name,
                    'id'   =>  $hotel?->id,
                    'google_rating'=>  $hotel->google_rating,
                    'google_rating_total' => $hotel->google_rating_total,
                    'rating' =>     $hotel->rating,
                    'popular'   =>         $hotel->papular, 
                    'recommended' =>     $hotel->recommended,
                    'parking_available' =>$hotel->parking_available,
                    'description' =>$hotel->description,
                    'hotel_img'   => $hotel->hotel_img?asset('storage/'.$hotel->hotel_img) : null,
                    'room'  =>  [
                                'id'=>$hotel->room?->id,
                                'hotel_id'=>$hotel->room?->hotel_id,
                                "room_type" =>$hotel->room?->room_type,
                                'plan' => [
                                    'id'=> $hotel->room?->plan?->id,
                                    'total_amount_ep'=> $hotel->room?->plan?->total_amount_ep??'',
                                ] 
                    ],
                ];
            }),
                'pagination' => [
                'total' => $this->total(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'next_page_url' => $this->nextPageUrl(),
                'prev_page_url' => $this->previousPageUrl(),
            ],
        ];
    }
}