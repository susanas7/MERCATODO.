<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => rand('1', '15'),
        'status' => rand('1', '15'),
        'quantity' => rand('1', '8'),
        'total' => rand('10', '80'),
    ];
});
