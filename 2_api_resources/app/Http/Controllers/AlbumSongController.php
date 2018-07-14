<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Album as AlbumResource;
use App\Http\Resources\Song as SongResource;

use App\Album;
use App\Song;

class AlbumSongController extends Controller
{
    public function index(Album $album)
    {
        return new AlbumResource($album->songs);
    }

    public function update(Album $album, Song $song)
    {
        $song->update([ 'album_id' => $album->id ]);

        return new SongResource($song);
    }
}
