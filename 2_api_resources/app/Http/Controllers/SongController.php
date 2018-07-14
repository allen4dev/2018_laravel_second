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
            request()->only([ 'artist_id', 'genre_id', 'name', 'album_id' ])
        );

        return (new SongResource($song))
                    ->response()
                    ->setStatusCode(201);
    }

    public function update(Song $song)
    {
        /**
         * ToDo: Handle the error in the render
         */

        if (! auth()->user()->can('update', $song)) {
            return response()->json([
                'error' => 'You are not allowed to perform this action'
            ], 403);
        }

        $song->update( request()->only([ 'genre_id', 'name' ]) );

        return (new SongResource($song->fresh()))
                    ->response()
                    ->setStatusCode(202);
    }

    public function destroy(Song $song)
    {
        if (! auth()->user()->can('delete', $song)) {
            return response()->json([
                'error' => 'You are not allowed to perform this action'
            ], 403);
        }
        
        $song->delete();

        return new SongResource($song);
    }
}
