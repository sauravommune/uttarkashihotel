<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
