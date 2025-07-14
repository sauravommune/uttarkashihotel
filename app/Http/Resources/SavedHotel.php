<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SavedHotel extends ResourceCollection
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
                'id' => $hotel?->id,
                'user_id' => $hotel->user_id,
                'hotel_id' => $hotel->hotel_id,
                'status' => $hotel->status,
                'hotel' => [
                    'id' => $hotel?->hotel?->id ?? '',
                    'name' => $hotel?->hotel?->name ?? '',
                    'google_rating' => $hotel?->hotel?->google_rating ?? '',
                    'rating' => $hotel?->hotel?->rating ?? '',
                    'google_rating_total' => $hotel?->hotel?->google_rating_total ?? '',
                    'description' => $hotel?->hotel?->description ?? '',
                    'parking_available' => $hotel?->hotel?->parking_available ?? '',
                    'hotel_img' => $hotel?->hotel?->hotel_img ? asset('storage/' . $hotel?->hotel?->hotel_img) : null,
                    'city_name' => $hotel?->hotel?->cityName ?? '',
                    'amenities' => $hotel?->hotel?->amenities->map(function ($amenity) {
                        return [
                            "id" => $amenity->id,
                            "amenity_id" => $amenity?->id,
                            "room_id" => $amenity?->hotel_id,
                            "amenity_name" => [
                                'name' => $amenity?->amenityName?->name
                            ],
                        ];
                    }),
                ]
            ];
        })->toArray(); // Convert collection to an array
    }
    
}