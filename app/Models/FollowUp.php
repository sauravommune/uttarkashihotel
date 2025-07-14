<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class FollowUp extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucWords($value),
        );
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function contact(): HasOneThrough
    {
        return $this->hasOneThrough(
            ContactInformation::class, Booking::class, 'id', 'booking_id', 'booking_id', 'booking_id'
        );
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'follow_up_by', 'id');
    }

}
