<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MetricUser extends Model
{
    protected $appends = ['name'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'date', 'user_id', 'total',
    ];

    /**
     * Relationship with the products.
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the name of user.
     *
     * @return string
     */
    /*public function getNameAttribute(): string
    {
        return $this->user->name;
    }*/
}
