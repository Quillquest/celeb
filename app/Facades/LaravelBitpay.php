<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelBitpay extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'bitpay';
    }
}
