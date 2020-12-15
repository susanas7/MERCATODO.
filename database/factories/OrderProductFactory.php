<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\OrderProduct;
use App\Product;
use Faker\Generator as Faker;

$factory->define(OrderProduct::class, function (Faker $faker) {
    return [
        'order_id' => rand('1', '15'),
        'product_id' => rand('1', '15'),
        'quantity' => rand('1', '8'),
        'price' => rand('10', '18'),
    ];
});
