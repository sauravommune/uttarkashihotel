<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class HotelResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->map(function ($hotel) {
            
            return [
                'name' =>  $hotel['hotel']->name,
                'id'   =>  $hotel['hotel']->id,
                'sold_out' =>  $hotel['hotel']->sold_out,
                'popular' =>  $hotel['hotel']->papular, 
                'recommended' =>  $hotel['hotel']->recommended,
                'google_rating'=>  $hotel['hotel']->google_rating,
                'google_rating_total' => $hotel['hotel']->google_rating_total,
                'rating' =>     $hotel['hotel']->rating,
                'description' =>$hotel['hotel']->description,
                'parking_available' =>$hotel['hotel']->parking_available,
                'hotel_img'   => $hotel['hotel']->hotel_img?asset('storage/'.$hotel['hotel']->hotel_img): null,
                'amenities'   => $hotel['hotel']->amenities,
                'total_price'  => $hotel['total_price'],
                'per_night_price'  => $hotel['per_night_price'],
                'city_name'  => $hotel['city_name'],
                'availability'  => is_array($hotel['availableRoom']) ? count($hotel['availableRoom']) : $hotel['availableRoom'],
             ];
        })->toArray(); // Convert the collection to an array
    }
}