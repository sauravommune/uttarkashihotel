<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedHotel extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];


    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

}
