<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Artist as ArtistResource;

use App\Artist;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::all();

        return new ArtistResource($artists);
    }

    public function show(Artist $artist)
    {
        return new ArtistResource($artist);
    }

    public function update(Artist $artist, Request $request)
    {
        /**
         * ToDo: validate the request
         */        
        
        $artist->updateInformation($request);

        return (new ArtistResource($artist))
                    ->response()
                    ->setStatusCode(202);
    }
}
