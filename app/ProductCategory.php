<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
     * @return BelongsTo
     */
    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get all the categories cached.
     *
     * @return Collection
     */
    public static function categoriesCached(): Collection
    {
        return Cache::remember('product_categories', 100, function () {
            return self::select('id', 'title')->orderBy('title')->get();
        });
    }

    /**
     * @param Builder $query
     * @param string  $title
     * @return Builder
     */
    public function scopeTitle(Builder $query, string $title): Builder
    {
        return $query->where('title', 'LIKE', "%{$title}%");
    }

    /**
     * Clear cache when category is updated or created.
     *
     * @return void
     */
    public static function flushCache(): void
    {
        Cache::forget('product_categories');
    }
}
