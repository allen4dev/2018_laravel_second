<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Album as AlbumResource;

use App\Album;

class AlbumSongController extends Controller
{
    public function index(Album $album)
    {
        return new AlbumResource($album->songs);
    }
}
