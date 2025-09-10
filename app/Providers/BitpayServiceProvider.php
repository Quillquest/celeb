<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Bitpay\BitpayClient;

class BitpayServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('bitpay', function ($app) {
            $config = $app['config']->get('laravel-bitpay', []);
            return new BitpayClient($config);
        });
    }

    public function boot()
    {
        // no-op
    }
}
