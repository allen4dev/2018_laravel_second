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
}
