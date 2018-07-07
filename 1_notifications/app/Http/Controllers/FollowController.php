<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Notifications\UserFollowed;

use App\User;

class FollowController extends Controller
{
    public function store(User $user)
    {
        $user->follow();

        $user->notify(new UserFollowed());
    }
}
