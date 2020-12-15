<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any users.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('ver usuario');
    }

    /**
     * Determine whether the user can view the user.
     *
     * @param User $user
     * @param User $userB
     * @return bool
     */
    public function view(User $user, User $userB): bool
    {
        return $user->can('ver usuario');
    }

    /**
     * Determine whether the user can create users.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('crear usuario');
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        return $user->can('editar usuario');
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function delete(User $user, User $model): bool
    {
        return $user->can('eliminar usuario');
    }
}
