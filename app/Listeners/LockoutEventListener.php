<?php

namespace App\Listeners;

use App\Models\User;

class LockoutEventListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        User::where('username', $event->input('username'))
        ->update([
            'status' => 'locked',
        ]);
    }
}
