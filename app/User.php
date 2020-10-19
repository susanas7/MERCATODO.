<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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
        'id', 'name', 'email', 'password', 'role', 'status',
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
    public function scopeName($query, $name)
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

    public function data()
    {
        return $this->hasOne(UserData::class);
    }

    /**
    * Relationship with orders
    *
    * @return relationship
    */
    public function orders()
    {
        return $this->hasMany('App\Order');
    }

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
