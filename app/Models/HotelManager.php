<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HotelManager extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    // Define the table if it's different from the model name
    protected $table = 'hotel_managers';

}
