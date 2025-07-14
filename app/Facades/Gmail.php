<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Gmail extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'gmail';
    }
}
