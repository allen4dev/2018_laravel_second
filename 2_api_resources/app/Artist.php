<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $guarded = [];

    public function user()
    {
        // return $this->hasOne(User::class);
        return $this->belongsTo(User::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }

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
