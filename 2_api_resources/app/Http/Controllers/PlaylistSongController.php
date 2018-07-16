<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Song as SongResource;

use App\Playlist;
use App\Song;

class PlaylistSongController extends Controller
{
    public function index(Playlist $playlist)
    {
        return new SongResource($playlist->songs);
    }

    public function store(Playlist $playlist)
    {
        $playlist->songs()->attach(request('songs'), ['user_id' => auth()->id()]);

        return (new SongResource($playlist->songs))
                    ->response()
                    ->setStatusCode(201);
    }

    public function destroy(Playlist $playlist, Song $song)
    {
        $playlist->songs()->detach($song);

        return new SongResource($song);
    }
}
