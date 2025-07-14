<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HotelData extends Model
{
    //
    protected $fillable = [
        'city',
        'latitude',
        'longitude',
        'hotel',
        'room_type',
        'price_type',
        'price',
        'b2b_price',
        'check_in',
        'check_out',
        'bed_type',
        'extra_bed',
        'parking',
        'parking_type',
        'amenities',
        'guest_meal',
        'breakfast',
        'pet_allow',
        'couple_friendly',
        'banquet',
        'conference',
        'day_used_room',
        'smoking_allowed',
        'rating',
        'room_size',
        'size_in',
        'meal_offered'
    ];

    // If using JSON fields
    protected $casts = [
        'amenities' => 'array',
        'breakfast' => 'array',
        'meal_offered' => 'array',
    ];
    public function images() : HasMany {
        return $this->hasMany(HotelImage::class,'hotel_data_id','id');
    }
    public function roomTypes() : HasMany {
        return $this->hasMany(ExternalHotelRoomType::class,'hotel_id','id');
    }
}
