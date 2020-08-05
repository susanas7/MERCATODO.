<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'title', 'slug', 'price', 'status', 'category_id', 'img_route',
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
        return $query->where('title', 'LIKE', "%{$title}%");
    }

    /**
     * @param string $slug
     */
    public function scopeSlug(Builder $query, $slug): Builder
    {
        if (null !== $slug) {
            return $this->searchByField($query, 'slug', $slug, '=');
        }

        return $query;
    }

    /**
     * @param strin $value
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
