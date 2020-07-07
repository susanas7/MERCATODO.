<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title', 'slug', 'price'
    ];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }
}
