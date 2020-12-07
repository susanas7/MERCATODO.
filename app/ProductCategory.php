<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class ProductCategory extends Model
{
    protected $table = 'product_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * Relationship with the product.
     *
     * @return relationship
     */
    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get all the categories cached.
     *
     * @return ProductCategory
     */
    public static function categoriesCached():Collection
    {
        return Cache::remember('product_categories', 100, function () {
            return self::select('id', 'title')->orderBy('title')->get();
        });
    }

    /**
     * @param Builder $query
     * @param string  $title
     *
     * @return Builder
     */
    public function scopeTitle(Builder $query, string $title)
    {
        return $query->where('title', 'LIKE', "%{$title}%");
    }

    public static function flushCache(): void
    {
        Cache::forget('product_categories');
    }
}
