<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    /**
     * Relationship with the products.
     *
     * @return BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the title of product.
     *
     * @return string
     */
    public function getTitleAttribute(): string
    {
        return $this->product->title;
    }
}
