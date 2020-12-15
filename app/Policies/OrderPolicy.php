<?php

namespace App\Policies;

use App\Order;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any orders.
     *
     * @param  User $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->can('ver orden');
    }

    /**
     * Determine whether the user can view the order.
     *
     * @param  User $user
     * @param  Order $order
     * @return bool
     */
    public function view(User $user, Order $order): bool
    {
        return $user->can('ver orden');
    }
}
