<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public function products()
    {
        return $this->belongsTo(Product::class);
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
