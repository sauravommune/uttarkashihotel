<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Hotel extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    public function rooms(){
        return $this->hasMany(Room::class,'hotel_id','id');
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Images::class, 'imageable');
    }

    public function cityName(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city','id');
    }

    public function amenities() :HasMany
    {
        return $this->hasMany(AddAmenity::class, 'hotel_id','id');
    }

    public function breakfast() :HasMany
    {
        return $this->hasMany(HotelBraekfast::class, 'hotel_id','id');
    }

    public function bankDetail() :HasOne
    {
        return $this->hasOne(HotelBankDetails::class, 'hotel_id','id');
    }

    public function getRoom(){

        return $this->hasMany(Room::class);
    }

    public function city(){
        return $this->hasOne(City::class, 'id','city');
    }

    public function cityDetails(){
        return $this->hasOne(City::class, 'id','city');
    }

    public function hotelImages(): MorphMany
    {
        return $this->morphMany(Images::class,'imageable');
    }

    public function priceRange(){
        return $this->hasMany(RatePlan::class,'hotel_id','id');
    }

    public function room()
    {
        return $this->hasOne(Room::class ,'hotel_id','id');
    }

    public function hotelImg()
    {
        return $this->hasOne(Images::class, 'imageable_id','id');
    }

    public function nearByPlace()
    {
        return $this->hasMany(NearByPlaceDistance::class, 'hotel_id','id');
    }

    public function hotelMeta(): HasOne
    {
        return $this->hasOne(HotelSEO::class);
    }

    public function VendorTransaction(): HasMany
    {
        return $this->hasMany(VendorTransaction::class);
    }

    public function hotelReview(){
        return $this->hasMany(HotelReview::class);
    }
}
