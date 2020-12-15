<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'price', 'status', 'category_id', 'img_route',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at', 'img_route',
    ];

    /**
     * Relationship with the category.
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class);
    }

    /**
     * @param Builder $query
     * @param string  $title
     * @return Builder
     */
    public function scopeTitle(Builder $query, string $title = null): Builder
    {
        return $query->where('title', 'LIKE', "%{$title}%")
            ->orWhere('slug', 'LIKE', "%{$title}%");
    }

    /**
     * @param Builder $query
     * @param string $field
     * @param string $value
     * @param string $operator|null
     * @return Builder
     */
    public function searchByField(Builder $query, string $field, string $value, string $operator = null): Builder
    {
        return $query->where($field, $operator, $value);
    }

    /**
     * Get the image of product.
     *
     * @return string|null
     */
    public function getGetImageAttribute(): ?string
    {
        if ($this->img_route) {
            return url("storage/{$this->img_route}");
        }
        return null;
    }

    /**
     * Relationship with the orders.
     *
     * @return HasToMany
     */
    public function orders(): HasToMany
    {
        return $this->HasMany(Order::class);
    }

    /**
     * Relationship with the metrics.
     *
     * @return BelongsTo
     */
    public function metrics(): BelongsTo
    {
        return $this->belongsTo(MetricProduct::class);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeForIndex(Builder $query): Builder
    {
        return $query
            ->select('id', 'title', 'slug', 'is_active', 'price', 'img_route')
            ->addSelect(
                [
                'category_title' => ProductCategory::select('title')
                    ->whereColumn('products.category_id', 'id')
                    ->limit(1),
                ]
            );
    }
}
