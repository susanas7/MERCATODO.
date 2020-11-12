<?php

namespace App\Providers;

use Dnetix\Redirection\PlacetoPay;
use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;
use App\User;

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
        User::observe(UserObserver::class);
    }
}
