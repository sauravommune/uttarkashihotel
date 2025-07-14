<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class NearByPlaceDistance extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    public function placeName(){

        return $this->hasOne(NearByPlace::class,'id','near_by_place');
    }
}
