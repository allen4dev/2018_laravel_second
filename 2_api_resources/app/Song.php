<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public function path()
    {
        return '/api/songs/' . $this->id;
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
