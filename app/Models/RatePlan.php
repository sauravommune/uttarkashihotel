<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RatePlan extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    protected $casts = [
        'rate_list' => 'array'
    ];

    // Define the relationship with the Hotel model
    public function hotel(): BelongsTo
    {
        return $this->belongsTo(Hotel::class);
    }

    protected function room(): BelongsTo
    {
       return $this->belongsTo(Room::class,'room_type','id');
    }

    public function RatePlanConfig(): HasMany
    {
        return $this->hasMany(RatePlanConfig::class);
    }
}
