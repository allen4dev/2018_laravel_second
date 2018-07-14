<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Album as AlbumResource;

use App\Artist;

class ArtistAlbumController extends Controller
{
    public function index(Artist $artist)
    {
        $albums = $artist->albums;

        return new AlbumResource($albums);
    }
}
