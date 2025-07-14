<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
                'id' => $this->id,
                'name' => $this->name,
                'sold_out'        =>  $this->sold_out,
                'general_rules'   =>  $this->general_rules,   
                'optinal_rules'   =>  $this->optinal_rules,
                'check_in_time'   =>  $this->check_in_time,   
                'check_out_time'   => $this->check_out_time,
                'popular'   =>         $this->papular, 
                'recommended' =>     $this->recommended,
                'cityName' => [
                    'id' =>$this->cityDetails->id,
                    'name' =>$this->cityDetails->name
                 ],
                'description' => $this->description,
                'rating' => $this->rating,
                'google_rating' => $this->google_rating,
                'google_rating_total' => $this->google_rating_total,
                'map_url' => $this->map_url,
                'embed_map_url' => $this->embed_map_url,
                'parking_available' =>$this->parking_available,
                'hotel_review' => $this->hotel_review,
                'hotel_images' => $this->hotelImages->map(function($hotel_img){
                    return [
                        'id' => $hotel_img->id,
                        'image' =>$hotel_img->image?asset('storage/'.$hotel_img->image) : null,
                    ];
                 }),
                // 'room' => $this->room,
                'room' => [
                    'id' =>$this->room?->id,
                    'hotel_id'=>$this->room?->hotel_id,
                     'room_type' => [
                        'id'=> $this->room?->roomType?->id??'',
                        'name'=> $this->room?->roomType?->name??'',
                     ],
                    
                    'total_room' => $this->room?->total_room,
                    'description' =>$this->room?->description,
                    'stay_guest' => $this->room?->stay_guest,
                    'room_size' => $this->room?->room_size??'',
                    'measure' => $this->room?->measure??'',
                    ],
                // 'amenities' => $this->amenities,

                'amenities' => $this->amenities->map(function($amenity){

                    return [
                        "id"=>$amenity->id,
                        "amenity_id"=>$amenity?->id,
                        "room_id"=>$amenity?->hotel_id,
                        "amenity_name"=>[
                         'name'=>  $amenity?->amenityName?->name
                        ],
                    ];
                }),
        ];
    }
}