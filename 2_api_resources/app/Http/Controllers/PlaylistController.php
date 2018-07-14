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

    public function store()
    {
        $playlist = Playlist::create([
            'title'       => request('title'),
            'description' => request('description'),
            'user_id'     => auth()->id(),
        ]);

        return (new PlaylistResource($playlist))
                    ->response()
                    ->setStatusCode(201);
    }

    public function show(Playlist $playlist)
    {
        return new PlaylistResource($playlist);
    }
}
