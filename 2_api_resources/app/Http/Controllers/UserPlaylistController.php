<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Playlist as PlaylistResource;

use App\User;

class UserPlaylistController extends Controller
{
    public function index(User $user)
    {
        return new PlaylistResource($user->playlists);
    }
}
