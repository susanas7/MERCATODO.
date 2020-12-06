<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_LOCAL_19467 extends Model
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

    /*public function active(){
        if($this->status=='active'){
          return true;
        }
        return false;
      }*/
}
