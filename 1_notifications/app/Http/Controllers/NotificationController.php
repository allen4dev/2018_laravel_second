<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class NotificationController extends Controller
{
    public function destroy(User $user, $notificationId)
    {
        $user->notifications()->find($notificationId)->markAsRead();
    }
}
