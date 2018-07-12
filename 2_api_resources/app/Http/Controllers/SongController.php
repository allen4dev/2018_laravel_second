<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Song as SongResource;

use App\Song;

class SongController extends Controller
{
    public function index()
    {
        return new SongResource(Song::all());
    }

    public function show(Song $song)
    {
        return new SongResource($song);
    }

    public function store()
    {
        /**
         * ToDo: validate request
         */
        $song = Song::create(
            request()->only([ 'artist_id', 'genre_id', 'name' ])
        );

        return (new SongResource($song))
                    ->response()
                    ->setStatusCode(201);
    }
}
