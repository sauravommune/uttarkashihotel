<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomAvailability extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];
    protected $table = 'room_availablities';

    public function hotel() {
        return $this->hasOne(Hotel::class,'id','hotel_id');
    }
    public function room() {
        return $this->hasOne(Room::class,'id','room_id');
    }
}
