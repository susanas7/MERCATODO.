<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'order_id' => rand('1', '8'),
        'product_id' => rand('1', '8'),
        'quantity' => rand('1', '3'),
        'price' => rand('10', '18')
    ];
});
