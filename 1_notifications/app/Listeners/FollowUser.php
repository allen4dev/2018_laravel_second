<?php

namespace App\Listeners;

use App\Events\UserWasFollowed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FollowUser
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
        auth()->user()->following()->create([
            'follow_id' => $event->user->id,
        ]);
    }
}
