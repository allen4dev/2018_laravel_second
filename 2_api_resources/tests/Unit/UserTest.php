<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Artist;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_knows_his_path()
    {
        $user = create(User::class);

        $this->assertEquals($user->path(), "/api/users/{$user->id}");
    }

    /** @test */
    public function a_user_has_one_artist()
    {
        $user   = create(User::class);
        $artist = create(Artist::class, [ 'user_id' => $user->id ]);

        $this->assertInstanceOf(Artist::class, $user->fresh()->artist);
    }

    /** @test */
    public function a_user_has_many_playlists()
    {
        $user = create(User::class);

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $user->playlists
        );
    }
}
