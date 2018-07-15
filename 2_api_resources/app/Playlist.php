<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $guarded = [];

    public function path()
    {
        return '/api/playlists/' . $this->id;
    }

    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }
}
