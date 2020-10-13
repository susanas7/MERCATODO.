<?php

use App\ProductCategory;
use Faker\Generator as Faker;

$factory->define(ProductCategory::class, function (Faker $faker) {
    return [
        'id' => rand('1', '5'),
        'title' => $faker->sentence(2),
    ];
});
