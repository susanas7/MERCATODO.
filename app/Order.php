<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
     * Relationship with the products.
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
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
                    ->limit(1),
                ]
            );
    }

    /**
     * Relationship with the order details.
     *
     * @return BelongsTo
     */
    public function orderDetail(): BelongsTo
    {
        return $this->belongsTo(OrderProduct::class);
    }
}
