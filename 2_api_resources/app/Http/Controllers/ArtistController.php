<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Artist as ArtistResource;
use App\Http\Resources\ArtistCollection;

use App\Artist;

class ArtistController extends Controller
{
    public function index(Request $request)
    {
        $offset = $request->offset ?: 5;

        $artists = Artist::latest()->paginate($offset);

        return new ArtistCollection($artists);
    }

    public function show(Artist $artist)
    {
        if (request()->has('withSongs')) {
            $artist->load('songs');
        }

        return new ArtistResource($artist);
    }

    public function update(Artist $artist, Request $request)
    {
        /**
         * ToDo: Handle the error in the render
         */
        if (! auth()->user()->can('update', $artist)) {
            return response()->json([
                'error' => 'You are not allowed to modify this artist.'
            ], 403);
        }

        /**
         * ToDo: validate the request
         */
        
        $artist->updateInformation($request);

        return (new ArtistResource($artist))
                    ->response()
                    ->setStatusCode(202);
    }

    public function destroy(Artist $artist)
    {
        /**
         * ToDo: Handle the error in the render
         */
        if (! auth()->user()->can('delete', $artist)) {
            return response()->json([
                'error' => 'You are not authorized to perform this action'
            ], 403);
        }

        $artist->delete();

        auth()->user()->update([ 'artist_id' => null ]);

        return new ArtistResource($artist);
    }
}
