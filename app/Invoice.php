<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
    ];

    protected $table = 'invoices';

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
