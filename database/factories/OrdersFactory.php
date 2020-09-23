<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => '1',
        'status' => 'created',
        'quantity' => '14',
        'total' => '15000',
    ];
});
