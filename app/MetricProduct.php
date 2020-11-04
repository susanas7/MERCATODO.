<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetricProduct extends Model
{
    protected $table = 'product_metrics';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'date', 'product_id', 'total',
    ];
}
