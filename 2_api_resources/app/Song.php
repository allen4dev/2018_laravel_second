<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    public function path()
    {
        return '/songs/' . $this->id;
    }
}
