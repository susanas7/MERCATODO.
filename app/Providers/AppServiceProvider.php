<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Dnetix\Redirection\PlacetoPay;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        /*no funciona con las variables de entorno
        $placetopay = $this->app->singleton(PlacetoPay::class, function ($app) {
            return new PlacetoPay([
                'login' => env('PLACETOPAY_LOGIN'),
                'tranKey' => env('PLACETOPAY_TRANKEY'),
                'url' => env('PLACETOPAY_URL'),
            ]);
        });*/

        $placetopay = $this->app->singleton(PlacetoPay::class, function ($app) {
            return new PlacetoPay([
                'login' => '6dd490faf9cb87a9862245da41170ff2',
                'tranKey' => '024h1IlD',
                'url' => 'https://test.placetopay.com/redirection'
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
    }
}
