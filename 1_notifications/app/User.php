<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Events\UserWasFollowed;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function following()
    {
        return $this->hasMany(Follow::class);
    }

    public function followers()
    {
        return $this->hasMany(Follower::class);
    }

    public function follow()
    {
        event(new UserWasFollowed($this));

        return $this;
    }
}
