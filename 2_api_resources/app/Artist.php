<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    public function path()
    {
        return '/artists/' . $this->id;
    }
}
