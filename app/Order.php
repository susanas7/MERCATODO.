<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    /**
    * Relationship with the user
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
        'user_id', 'status', 'quantity', 'total', 'requestId', 'processUrl'
    ];

    /**
    * Relationship with the invoice
    *
    * @return relationship
    */
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
