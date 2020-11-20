<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;
use Spatie\Permission\Models\Role;
use App\Product;
use App\ProductCategory;
use App\Order;
use App\Policies\UserPolicy;
use App\Policies\RolePolicy;
use App\Policies\ProductPolicy;
use App\Policies\ProductCategoryPolicy;
use App\Policies\OrderPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         User::class => UserPolicy::class,
         Role::class => RolePolicy::class,
         Product::class => ProductPolicy::class,
         ProductCategory::class => ProductCategoryPolicy::class,
         Order::class => OrderPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
