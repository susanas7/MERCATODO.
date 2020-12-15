<?php

namespace App\Helpers;

use App\Product;

class RandomProducts
{
    /**
     * Return random products.
     *
     * @return object
     */
    public static function getRandomProducts(): object
    {
        $products = Product::where('is_active', 1)->pluck('id');
        $f = $products->first();
        $l = $products->last();
        $numbers = range($f, $l);
        shuffle($numbers);
        $final = array_slice($numbers, 0, 3);
        $collection = Product::whereIn('id', $final)->get();

        return $collection;
    }
}
