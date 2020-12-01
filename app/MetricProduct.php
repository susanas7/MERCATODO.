<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetricProduct extends Model
{
    protected $table = 'product_metrics';

    protected $appends = ['title'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'date', 'product_id', 'total',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getTitleAttribute()
    {
        return $this->product->title;
    }
}
