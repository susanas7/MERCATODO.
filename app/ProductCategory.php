<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class ProductCategory extends Model
{
    /**
    * Relationship with the product
    *
    * @return relationship
    */
    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    /**
    * Get all the categories cached
    *
    * @return ProductCategory
    */
    public static function categoriesCached():Collection
    {
        return Cache::remember('product_categories', 1200, function () {
            return ProductCategory::all();
        });
    }

    /**
     * @param Builder $query
     * @param string  $title
     *
     * @return Builder
     */
    public function scopeTitle($query, $title)
    {
        return $query->where('title', 'LIKE', "%{$title}%");
    }
}
