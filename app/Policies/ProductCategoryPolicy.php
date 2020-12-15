<?php

namespace App\Policies;

use App\ProductCategory;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categories.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('ver categoria');
    }

    /**
     * Determine whether the user can view the category.
     *
     * @param User $user
     * @param ProductCategory $productCategory
     * @return bool
     */
    public function view(User $user, ProductCategory $category): bool
    {
        return $user->can('ver categoria');
    }

    /**
     * Determine whether the user can create categories.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('crear categoria');
    }

    /**
     * Determine whether the user can update the category.
     *
     * @param User $user
     * @param ProductCategory $productCategory
     * @return bool
     */
    public function update(User $user, ProductCategory $category): bool
    {
        return $user->can('editar categoria');
    }

    /**
     * Determine whether the user can delete the category.
     *
     * @param User $user
     * @param ProductCategory $productCategory
     * @return bool
     */
    public function delete(User $user, ProductCategory $category): bool
    {
        return $user->can('eliminar categoria');
    }
}
