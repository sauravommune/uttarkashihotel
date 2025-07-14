<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MyBooking extends ResourceCollection
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
                'nights' => $hotel['nights']??'',
                'totalRoom' => $hotel['totalRoom']??"",
                'details' => [
                    'id' => $hotel['details']?->id ?? '',
                    'user_id' => $hotel['details']?->user_id ?? '',
                    'hotel_id' => $hotel['details']?->hotel_id ?? '',
                    'booking_id' => $hotel['details']?->booking_id ?? '',
                    'search_id' => $hotel['details']?->search_id ?? '',
                    'check_in_date' => $hotel['details']?->check_in_date ?? '',
                    'check_out_date' => $hotel['details']?->check_out_date ?? '',
                    'total_guest' => $hotel['details']?->total_guest ?? '',
                    'total_room' => $hotel['details']?->total_room ?? '',
                    'status' => $hotel['details']?->status ?? '',
                    'adult' => $hotel['details']?->adult ?? '',
                    'child' => $hotel['details']?->child ?? '',
                    'hotel' => [
                        'id' => $hotel['details']?->hotel?->id ?? '',
                        'name' => $hotel['details']?->hotel?->name ?? '',
                        'slug' => $hotel['details']?->hotel?->slug ?? '',
                        'city' => [
                            "id"=> $hotel['details']?->hotel?->cityDetails->id ?? '',
                            "name"=>$hotel['details']?->hotel?->cityDetails->name ??'',
                        ],
                        'google_rating' => $hotel['details']?->hotel?->google_rating ?? '',
                        'rating' => $hotel['details']?->hotel?->rating ?? '',
                        'google_rating_total' => $hotel['details']?->hotel?->google_rating_total ?? '',
                        'address' => $hotel['details']?->hotel?->address ?? '',
                        'description' => $hotel['details']?->hotel?->description ?? '',
                        'map_url' => $hotel['details']?->hotel?->map_url ?? '',
                        'embed_map_url' => $hotel['details']?->hotel?->embed_map_url ?? '',
                        'parking_available' => $hotel['details']?->hotel?->parking_available ?? '',
                        // 'hotel_img' => $hotel['details']?->hotel?->hotel_img?asset('storage/'.$hotel['details']?->hotel?->hotel_img) : null,
                        'amenities' => $hotel['details']?->hotel?->amenities?->map(function ($amenity) {
                            return [
                                "id" => $amenity->id,
                                "amenity_id" => $amenity?->id,
                                "room_id" => $amenity?->hotel_id,
                                "amenity_name" => [
                                    'name' => $amenity?->amenityName?->name
                                ],
                            ];
                        }) ?? [],
                    ],
                ],
            ];
        })->toArray(); // Convert collection to an array
    }
}
