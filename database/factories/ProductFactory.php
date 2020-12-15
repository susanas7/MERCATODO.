<?php

use App\Product;
use App\ProductCategory;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(1),
        'slug' => $faker->sentence(9),
        'price' => rand('10', '20'),
        'category_id' => factory(ProductCategory::class)->create(),
        'created_at' => $faker->dateTimeBetween('-6 months', 'now'),
        'is_active' => rand('0', '1'),
        'img_route' => $faker->imageUrl(600, 338),
    ];
});
