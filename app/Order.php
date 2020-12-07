<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Order extends Model
{
    /**
     * Relationship with the user.
     *
     * @return relationship
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'status', 'quantity', 'total', 'requestId', 'processUrl',
    ];

    /**
     * Relationship with the invoice.
     *
     * @return relationship
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function scopeForIndex(Builder $query): Builder
    {
        return $query
            ->select('id', 'status', 'total', 'created_at')
            ->addSelect(
                [
                'user_name' => User::select('name')
                    ->whereColumn('orders.user_id', 'id')
                    ->limit(1)
                ]
            );
    }
}
