<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServerKey extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [];

    protected $table = "server_keys";
    protected $primaryKey = 'id';

    public function GetSource(){
        return $this->belongsTo(Source::class, 'source');
    }

    public function GetUser(){
        return $this->belongsTo(User::class, 'created_by');
    }


}
