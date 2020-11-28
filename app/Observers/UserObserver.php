<?php

namespace App\Observers;

use App\User;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;

class UserObserver
{
    use HasRoles;

    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        /*if ($user->can('api')) {
            $user->api_token = 'di';
            $user->save();
        } else {
            $user->api_token = null;
            $user->save();
        }*/

        /*$user->can('api');
        $user->api_token = Str::random(50);
        $user->save();*/
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        /*if ($user->hasPermissionTo('api')) {
            $user->api_token = Str::random(50);
            $user->save();
        }*/
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
