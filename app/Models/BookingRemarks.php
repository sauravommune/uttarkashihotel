<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class BookingRemarks extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    protected $casts = [
        'changes'   => 'object',
    ];

    public function addedBy() : HasOne {
        return $this->hasOne(User::class,'id','added_by');
    }

}
