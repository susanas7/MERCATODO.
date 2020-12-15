<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\OrderProduct;
use App\Product;
use Faker\Generator as Faker;

$factory->define(OrderProduct::class, function (Faker $faker) {
    return [
        'order_id' => factory(Order::class)->create(),
        'product_id' => factory(Product::class)->create(),
        'quantity' => rand('1', '8'),
        'price' => rand('10', '18'),
        'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
    ];
});
