<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Room extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $fillable = [];

    public function amenities()
    {
        return $this->belongsToMany(Amenity::class, 'room_amenities');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Images::class, 'imageable');
    }

    public function roomPrice(){
        return $this->hasMany(RoomPrice::class,'room_id','id');
    }

    public function addAmenity(){
        return $this->hasMany(AddAmenity::class, 'room_id', 'id');
    }

    public function getBed(){
        return $this->hasMany(AddBed::class, 'room_id', 'id');

    }
    public function roomType(){
        return $this->hasOne(RoomCategory::class, 'id','room_type');
    }

    public function roomAvailability(){
        return $this->hasOne(RoomAvailability::class,'room_id','id');
    }

    public function ratePlan()
    {
        return $this->hasMany(RatePlan::class,'room_type','id');
    }

    public function roomImg()
    {
        return $this->hasOne(Images::class, 'imageable_id','id');
    }

    public function roomImages()
    {
        return $this->hasMany(Images::class, 'imageable_id','id');
    }

    public function plan()
    {
       return $this->hasOne(RatePlan::class,'room_type','id');
    }
}
