<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyMaster extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    /**
     * The table associated with the model.
     */
    protected $table = 'company_masters';

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'decimal',
    ];
}
