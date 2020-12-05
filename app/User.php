<?php

namespace App;

use App\Events\UserCreatedEvent;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'email', 'password', 'role', 'status', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param Builder
     * @param string $name
     * @param mixed  $query
     *
     * @return Builder
     */
    public function scopeName(Builder $query, $name): Builder
    {
        return $query->where('name', 'LIKE', "%{$name}%")
            ->orWhere('email', 'LIKE', "%{$name}%");
    }

    /**
     * @param strin $value
     */
    public function searchByField(Builder $query, string $field, string $value, string $operator = null): Builder
    {
        return $query->where($field, $operator, $value);
    }

    /**
     * Relationship with orders.
     *
     * @return relationship
     */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    protected $dispatchEvents = [
        'created' => UserCreatedEvent::class,
    ];

    public function generateToken()
    {
        $this->api_token = Str::random(60);
        $this->save();

        return $this->api_token;
    }
}
