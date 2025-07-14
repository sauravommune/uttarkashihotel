<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxCalculator extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
