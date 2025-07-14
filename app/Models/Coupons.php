<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    protected $guarded = ['id'];
    protected $table = 'coupons';

    // public function booking(): HasMany
    // {
    //     return $this->hasMany(Booking::class);
    // }

}
