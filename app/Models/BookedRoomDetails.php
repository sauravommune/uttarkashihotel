<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookedRoomDetails extends Model
{
    //
    protected $guarded= ['id'];
    protected $fillable = [];

    protected $appends = ['plan_name'];

    public function roomDetails(){
        return $this->hasOne(Room::class,'id','room_id');
    }
    public function roomCategory(){
        return $this->hasOne(RoomCategory::class,'id','room_category');
    }

    public function getPlanNameAttribute()
    {
        $plan_name = $this->break_fast_type;
        switch ($plan_name) {
            case 'Room Only':
                return 'EP';
            case 'With Breakfast':
                return 'CP';
            case 'With Breakfast Dinner':
                return 'MAP';
            default:
                return 'N/A';
        }
    }
}
