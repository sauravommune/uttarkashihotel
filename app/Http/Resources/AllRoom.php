<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AllRoom extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->map(function ($room) {  
            return [
                'total_price' => $room['total_price'] ?? 0,
                'per_night_price' => $room['per_night_price'] ?? 0,
                'total_price_with_break_fast' => $room['total_price_with_break_fast'] ?? 0,
                'total_price_with_break_fast_and_dinner' => $room['total_price_with_break_fast_and_dinner'] ?? 0,
                'nights' => $room['nights'] ?? 1,
                'availableRoom' => $room['availableRoom'] ?? 0,
                'rooms' => [
                    'id' => $room['rooms']?->id,
                    'hotel_id' => $room['rooms']?->hotel_id,
                    'room_type' => [
                        'id' => $room['rooms']?->roomType?->id ?? '',
                        'name' => $room['rooms']?->roomType?->name ?? '',
                    ],
                    'total_room' => $room['rooms']?->total_room,
                    'description' => $room['rooms']?->description,
                    'stay_guest' => $room['rooms']?->stay_guest,
                    'room_size' => $room['rooms']?->room_size ?? '',
                    'measure' => $room['rooms']?->measure ?? '',
                ],
                'room_images' => $room['rooms']?->roomImages->map(function ($room_img) {
                    return [
                        'id' => $room_img?->id,
                        'image' => $room_img?->image ? asset('storage/' . $room_img?->image) : null,
                    ];
                }),
                'add_amenity' => $room['rooms']?->addAmenity->map(function ($amenity) {
                    
                    return [
                        "id" => $amenity->id,
                        "amenity_id" => $amenity?->id,
                        "room_id" => $amenity?->room_id,
                        "amenity_name" => [
                            'name' => $amenity?->amenityName?->name
                        ],
                    ];
                }),
            ];
        })->toArray();
    }   
}