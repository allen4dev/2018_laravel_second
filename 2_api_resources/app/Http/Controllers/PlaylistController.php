<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Playlist as PlaylistResource;

use App\Playlist;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::all();

        return new PlaylistResource($playlists);
    }
}
