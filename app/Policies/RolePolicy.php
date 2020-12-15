<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\Permission\Models\Role;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any roles.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('ver rol');
    }

    /**
     * Determine whether the user can view the role.
     *
     * @param User $user
     * @param Role $model
     * @return bool
     */
    public function view(User $user, Role $model): bool
    {
        return $user->can('ver rol');
    }

    /**
     * Determine whether the user can create roles.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('crear rol');
    }

    /**
     * Determine whether the user can update the role.
     *
     * @param User $user
     * @param Role $role
     * @return bool
     */
    public function update(User $user, Role $role): bool
    {
        return $user->can('editar rol');
    }

    /**
     * Determine whether the user can delete the role.
     *
     * @param User $user
     * @param Role $role
     * @return bool
     */
    public function delete(User $user, Role $role): bool
    {
        return $user->can('eliminar rol');
    }
}
