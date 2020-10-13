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
    public function scopeTitle($query, $title)
    {
        return $query->where('title', 'LIKE', "%{$title}%")
            ->orWhere('slug', 'LIKE', "%{$title}%");
    }

    /**
     * @param string $value
     */
    public function searchByField(Builder $query, string $field, string $value, string $operator = null): Builder
    {
        return $query->where($field, $operator, $value);
    }

    public function getGetImageAttribute()
    {
        if ($this->img_route) {
            return url("storage/{$this->img_route}");
        }
    }
}
