<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoogleCredential extends Model
{
    protected $fillable = [
        'name',
        'google_client_id',
        'google_client_secret',
        'google_redirect',
    ];
}
