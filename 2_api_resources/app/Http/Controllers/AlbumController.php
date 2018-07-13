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
}
