<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Song as SongResource;

use App\Song;

class SongController extends Controller
{
    public function index()
    {
        return new SongResource(Song::all());
    }
}
