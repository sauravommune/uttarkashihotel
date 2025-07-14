<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    public function getHotel(){
        return $this->hasMany(Hotel::class,'city','id');
    }

    public function nearPlaces(){
        return $this->hasMany(NearByPlace::class,'city_id','id');
    }

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
    public function nearPlacesDistance(){

        return $this->hasMany(NearByPlaceDistance::class,'hotel_id','id');
    }
    
}
