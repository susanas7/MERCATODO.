<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

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
        'updated_at', 'img_route',
    ];

    /**
    * Relationship with the category
    *
    * @return relationship
    */
    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function active()
    {
        if ('active' === $this->status) {
            return true;
        }

        return false;
    }

    /**
     * @param Builder $query
     * @param string  $title
     *
     * @return Builder
     */
    public function scopeTitle(Builder $query, string $title = null)
    {
        return $query->where('title', 'LIKE', "%{$title}%")
            ->orWhere('slug', 'LIKE', "%{$title}%");
    }

    /**
     * @param Builder $query
     * @param string $field
     * @param string $value
     * @param string $operator
     */
    public function searchByField(Builder $query, string $field, string $value, string $operator = null): Builder
    {
        return $query->where($field, $operator, $value);
    }

    /**
    * Get the image of product
    *
    * @return image
    */
    public function getGetImageAttribute()
    {
        if ($this->img_route) {
            return url("storage/{$this->img_route}");
        }
    }

    /**
     * Relationship with the orders
     * 
     * @return relationship
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
