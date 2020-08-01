<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use HasRoles;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'status',
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
     * @return Builder
     */
    public function scopeName($query, $name)
    {
        return $query->where('name', 'LIKE', "%$name%");
    }

    /**
     * @param Builder $query
     * @param string $email
     * @return Builder
     */
    public function scopeEmail(Builder $query, $email): Builder
    {
        if (null !== $email) {
            return $this->searchByField($query, 'email', $email, '=');
        }
        return $query;
    }

    /**
     * @param Builder $query
     * @param string $field
     * @param string $value
     * @param string|null $operator
     * @return Builder
     */
    public function searchByField(Builder $query, string $field, string $value, string $operator = null): Builder
    {
        return $query->where($field, $operator, $value);
    }
}
