<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'title', 'slug', 'price', 'images', 'status', 'category_id', 'img_route',
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function imagesProducts()
    {
        return $this->hasMany('App\ImgProducts');
    }

    public function active()
    {
        if ($this->status=='active') {
            return true;
        }
        return false;
    }

     /**
     * @param Builder $query
     * @param string $title
     * @return Builder
     */
    public function scopeTitle($query, $title)
    {
        return $query->where('title', 'LIKE', "%$title%");
    }
  
     /**
     * @param Builder $query
     * @param string $slug
     * @return Builder
     */
    public function scopeSlug(Builder $query, $slug): Builder
    {
        if (null !== $slug) {
            return $this->searchByField($query, 'slug', $slug, '=');
        }
        return $query;
    }
  
    /**
     * @param Builder $query
     * @param string $field
     * @param strin $value
     * @param string|null $operator
     * @return Builder
     */
    public function searchByField(Builder $query, string $field, string $value, string $operator = null): Builder
    {
        return $query->where($field, $operator, $value);
    }

    public function getGetImageAttribute()
    {
        if ($this->img_route) {
            return url("storage/$this->img_route");
        }
    }
}
