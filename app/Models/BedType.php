<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AddBed;

class BedType extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    public function totalBedType(){

        return $this->hasMany(AddBed::class, 'bed_type_id','id');

    }

}
