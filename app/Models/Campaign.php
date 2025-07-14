<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    // Define the table name if it's not the plural of the model name
    protected $table = 'campaigns';

    // Optionally define relationships if needed
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
