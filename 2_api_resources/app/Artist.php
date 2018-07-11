<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $guarded = [];

    public function path()
    {
        return '/api/artists/' . $this->id;
    }

    public function updateInformation($request)
    {
        $this->update($request->only([
            'firstname',
            'lastname',
            'nickname',
            'photo_url',
            'age',
            'description',
        ]));

        return $this;
    }
}
