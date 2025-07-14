<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllUser extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    protected $table = 'all_users';
}
