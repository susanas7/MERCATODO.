<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use Illuminate\Support\Str;

class UserCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserCreatedEvent $event)
    {
        /*$user = $event->user;

        if ($user->can('api')) {
            $user->api_token = Str::random(50);
            $user->save();
        }*/
    }
}
