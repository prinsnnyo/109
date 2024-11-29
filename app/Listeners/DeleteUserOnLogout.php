<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DeleteUserOnLogout
{
    /**
     * Handle the event.
     *
     * @param  \Illuminate\Auth\Events\Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        // Check if the user is authenticated
        if ($event->user) {
            // Remove the user from the database
            User::where('google_id', $event->user->google_id)->delete();
        }
    }
}