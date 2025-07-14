<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchLog extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    protected $table = "search_logs";
    protected $casts = [
        'child_ages' => 'array'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

}
