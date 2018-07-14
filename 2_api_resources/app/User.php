<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function path()
    {
        return '/api/users/' . $this->id;
    }

    public function artist()
    {
        return $this->hasOne(Artist::class);
        // return $this->belongsTo(Artist::class);
    }
    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    public function upgrade()
    {
        /**
         * ToDo: Refactor to FormRequest
         */
        request()->validate([
            'firstname'   => 'required',
            'lastname'    => 'required',
            'age'         => 'required',
            'description' => 'required',
        ]);

        $artist = $this->artist()->create([
            'firstname'   => request('firstname'),
            'lastname'    => request('lastname'),
            'age'         => request('age'),
            'description' => request('description'),
            'user_id'     => auth()->id(),
        ]);

        $this->update([ 'artist_id' => $artist->id]);

        return $artist;
    }
}
