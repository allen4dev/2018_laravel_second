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

        return (new ArtistResource($artists))
            ->response()
            ->setStatusCode(200);
    }

    public function show(Artist $artist)
    {
        return (new ArtistResource($artist))
            ->response()    
            ->setStatusCode(200);
    }
}
