<?php

namespace App\Providers;

use App\Order;
use App\Policies\OrderPolicy;
use App\Policies\ProductCategoryPolicy;
use App\Policies\ProductPolicy;
use App\Policies\RolePolicy;
use App\Policies\UserPolicy;
use App\Product;
use App\ProductCategory;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Spatie\Permission\Models\Role;
use App\MetripProduct;
use App\Policies\MetricPolicy;

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
         MetricProduct::class => MetricPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
