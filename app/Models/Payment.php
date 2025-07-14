<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
    }

    public function contactInformation(): BelongsTo
    {
        return $this->belongsTo(ContactInformation::class, 'booking_id', 'booking_id');
    }
    
}
