<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddBed extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    public function getRoom(){

        return $this->hasOne(Room::class,'id','room_id');
    }

    public function bedTypeName(){

        return $this->hasOne(BedType::class,'id','bed_type_id');

    }

}
