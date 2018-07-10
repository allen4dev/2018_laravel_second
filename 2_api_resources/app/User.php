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
        return '/users/' . $this->id;
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function upgrade()
    {
        $artist = $this->artist()->create([
            'firstname' => 'My artist name',
            'user_id'   => auth()->id(),
        ]);

        $this->update([ 'artist_id' => $artist->user_id]);

        return $artist;
    }
}
