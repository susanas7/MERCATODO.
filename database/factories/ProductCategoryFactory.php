<?php

use App\ProductCategory;
use Faker\Generator as Faker;

$factory->define(ProductCategory::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(2),
    ];
});
