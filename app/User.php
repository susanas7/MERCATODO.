<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

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

    public function scopeName($query, $name){
        return $query->where('name', 'LIKE', "%$name%");
    }

    public function scopeEmail(Builder $query, $email): Builder
    {
        //return $query->where('email', 'LIKE', "&$email%");
        if (null !== $email) {
            return $this->searchByField($query, 'email', $email, '=');
        }

        return $query;
    }
    private function searchByField(Builder $query, string $field, string $value, string $operator = null): Builder
    {
        return $query->where($field, $operator, $value);
    }

    public function scopeSearch($query, $type, $search)
    {
        if( ($type) && ($search) ){
            return $query->where($type, 'like', "%$search%");            
        }
    }

}
