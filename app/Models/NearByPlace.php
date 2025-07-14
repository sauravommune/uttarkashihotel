<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NearByPlace extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    public function placeDistance()  {
        return $this->hasMany(NearByPlaceDistance::class,'near_by_place','id');
    }
}
