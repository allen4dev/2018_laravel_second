<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\Artist as ArtistResource;

use App\Artist;
use App\User;

class UpgradeUserController extends Controller
{
    public function index(User $user)
    {
        $artist = $user->upgrade();

        return (new ArtistResource($artist->fresh()))
            ->response()
            ->setStatusCode(202);
    }
}
