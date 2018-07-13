<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Album as AlbumResource;

use App\Album;

class AlbumController extends Controller
{
    public function index()
    {
        $albums = Album::all();

        return new AlbumResource($albums);
    }

    public function show(Album $album)
    {
        return new AlbumResource($album);
    }

    public function store()
    {
        /**
         * ToDo: Validate the request
         */

        $album = Album::create([
            'title'     => request('title'),
            'artist_id' => auth()->user()->artist->id,
        ]);

        return (new AlbumResource($album))
                    ->response()
                    ->setStatusCode(201);
    }

    public function update(Album $album)
    {
        if (! auth()->user()->can('update', $album)) {
            return response()->json([
                'error' => 'You are not allowed to perform this action'
            ], 403);
        }

        $album->update([ 'title' => request('title') ]);

        return (new AlbumResource($album))
                    ->response()
                    ->setStatusCode(202);
    }

    public function destroy(Album $album)
    {
        if (! auth()->user()->can('delete', $album)) {
            return response()->json([
                'error' => 'You are not allowed to perform this action'
            ], 403);
        }

        $album->delete();

        return new AlbumResource($album);
    }
}
