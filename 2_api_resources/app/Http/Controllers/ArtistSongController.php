<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Song as SongResource;

use App\Artist;

class ArtistSongController extends Controller
{
    /**
     * ToDo: If is the only method move to SongController@index
     */
    public function index(Artist $artist)
    {
        $songs = $artist->songs;

        return new SongResource($songs);
    }
}
