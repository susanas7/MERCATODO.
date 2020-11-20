<?php

namespace App\Policies;

use App\ProductCategory;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('ver categoria');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProductCategory  $productCategory
     * @return mixed
     */
    public function view(User $user, ProductCategory $productCategory)
    {
        return $user->can('ver categoria');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->can('crear categoria');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProductCategory  $productCategory
     * @return mixed
     */
    public function update(User $user, ProductCategory $category)
    {
        return $user->can('editar categoria');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProductCategory  $productCategory
     * @return mixed
     */
    public function delete(User $user, ProductCategory $category)
    {
        return $user->can('eliminar categoria');
    }
}
