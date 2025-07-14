<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecommendHotel extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    public function recommendHotel()
    {
       return $this->belongsTo(Hotel::class,'hotel_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }   

}
