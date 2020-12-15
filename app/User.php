<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
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
     * @param Builder $query
     * @param string $name
     * @return Builder
     */
    public function scopeName(Builder $query, $name): Builder
    {
        return $query->where('name', 'LIKE', "%{$name}%")
            ->orWhere('email', 'LIKE', "%{$name}%");
    }

    /**
     * @param Builder $query
     * @param string $field
     * @param string $value
     * @param string $operator|null
     * @return Builder
     */
    public function searchByField(Builder $query, string $field, string $value, string $operator = null): Builder
    {
        return $query->where($field, $operator, $value);
    }

    /**
     * Relationship with orders.
     *
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany('App\Order');
    }

    /**
     * Generate api token for users.
     *
     * @return User
     */
    public function generateToken(): self
    {
        $this->api_token = Str::random(60);
        $this->save();

        return $this->api_token;
    }

    /**
     * Get permissions cached.
     *
     * @return Collection
     */
    public function getPermissionsAttribute(): Collection
    {
        $permissions = Cache::rememberForever('permissions', function () {
            return Permission::select('permissions.*', 'model_has_permissions.*')
            ->join('model_has_permissions', 'permissions.id', '=', 'model_has_permissions.permission_id')
            ->get();
        });

        return $permissions->where('model_id', $this->id);
    }

    /**
     * Get roles cached.
     *
     * @return Collection
     */
    public function getRolesAttribute(): Collection
    {
        $roles = Cache::rememberForever('roles', function () {
            return Role::select('roles.*', 'model_has_roles.*')
            ->join('model_has_roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->get();
        });

        return $roles->where('model_id', $this->id);
    }
}
