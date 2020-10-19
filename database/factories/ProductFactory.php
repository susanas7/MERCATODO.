<?php

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'slug' => $faker->slug(4),
        'price' => rand('10', '20'),
        'category_id' => rand('1', '5'),
        'img_route' => $faker->imageUrl(600, 338),
    ];
});
