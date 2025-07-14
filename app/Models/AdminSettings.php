<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSettings extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    
    protected $casts = [
        'invoice_settings' => 'array',
        'payment_gateways' => 'array',
        'email_settings' => 'array'
    ];
}
