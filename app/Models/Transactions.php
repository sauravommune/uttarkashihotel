<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'guest_name',
        'hotel',
        'city',
        'payment_id',
        'payment_date',
        'mode',
        'pcbh',
        'mkup',
        'gctp',
        'rzp_fee',
        'total',
        'pmnt',
        'wrk',
    ];

    protected $casts = [
        'pcbh' => 'decimal:2',
        'mkup' => 'decimal:2',
        'gctp' => 'decimal:2',
        'rzp_fee' => 'decimal:2',
        'total' => 'decimal:2',
        'payment_date' => 'datetime',
    ];
}
