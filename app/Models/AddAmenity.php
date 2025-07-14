<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddAmenity extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    public function amenityName(){

        return $this->hasOne(Amenity::class, 'id', 'amenity_id');
    }

    public function hotel(){

        return $this->hasOne(Hotel::class,'id','hotel_id');
    }
}
