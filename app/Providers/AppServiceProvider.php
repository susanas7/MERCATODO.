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
        $placetopay = $this->app->singleton(PlacetoPay::class, function ($app) {
            return new PlacetoPay([
                'login' => config('app.placetopay.login'),
                'tranKey' => config('app.placetopay.trankey'),
                'url' => config('app.placetopay.url'),
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
