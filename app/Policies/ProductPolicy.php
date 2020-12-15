<?php

namespace App\Policies;

use App\Product;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any products.
     *
     * @param User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('ver producto');
    }

    /**
     * Determine whether the user can view the product.
     *
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function view(User $user, Product $product): bool
    {
        return $user->can('ver producto');
    }

    /**
     * Determine whether the user can create products.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $user->can('crear producto');
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function update(User $user, Product $product): bool
    {
        return $user->can('editar producto');
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param User $user
     * @param Product $product
     * @return bool
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->can('eliminar producto');
    }
}
