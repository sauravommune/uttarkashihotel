<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords( str_replace("_", " ", $value) ),
            set: fn (string $value) => strtolower($value),
        );
    }

    public function bookingTraveler(){
        return $this->hasMany(TravellerDetails::class,'booking_id','booking_id');
    }

    public function bookingContact(){
        return $this->hasOne(ContactInformation::class,'booking_id','booking_id');
    }

    public function Room(){
        return $this->hasOne(Room::class,'id','room_id');
    }

    public function hotel(){
        return $this->hasOne(Hotel::class,'id','hotel_id');
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }

    public function payments(){
        return $this->hasOne(Payment::class,'booking_id','booking_id')->where('is_initial',1);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Payment::class, 'booking_id', 'booking_id');
    }

    public function travelers(){
        return $this->hasMany(TravellerDetails::class,'booking_id','booking_id');
    }

    public function contactInfo(){
        return $this->hasOne(ContactInformation::class,'booking_id','booking_id');
    }

    public function remarks(){
        return $this->hasMany(BookingRemarks::class);
    }


    public function bookedRooms(){
        return $this->hasMany(BookedRoomDetails::class,'booking_id','booking_id');
    }

    public function bookingEmails(): HasMany
    {
        return $this->hasMany(BookingEmails::class);
    }

    public function vendorStatus(): HasOne
    {
        return $this->hasOne(HotelVendorBookingStatus::class);
    }

    public function currentLeadEmployee(): HasOne
    {
        return $this->hasOne(LeadEmployee::class)->where('completed_at', null);
    }

    public function leadEmployee(): HasMany
    {
        return $this->hasMany(LeadEmployee::class);
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public function VendorTransaction(): HasMany
    {
        return $this->hasMany(VendorTransaction::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupons::class);
    }

    public function feedBack(): HasOne
    {
        return $this->hasOne(Feedback::class);
    }

    public function followUps(): HasMany
    {
        return $this->hasMany(FollowUp::class);
    }
}
