<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HotelSEO extends Model
{
    //
    protected $guarded = ['id'];
    protected $fillable = [];

    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }
}
