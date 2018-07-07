<?php

namespace App\Listeners;

use App\Events\UserWasFollowed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AddFollower
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserWasFollowed  $event
     * @return void
     */
    public function handle(UserWasFollowed $event)
    {
        $event->user->followers()->create([
            'follower_id' => auth()->id(),
        ]);
    }
}
