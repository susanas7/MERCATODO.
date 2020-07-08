<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImgProducts extends Model
{
    protected $table = 'img_products';

    protected $fillable = ['name', 'format', 'product_id'];

    public function products()
    {
        return $this->belongsTo('App\Product');
    }
}
