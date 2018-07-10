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

        $this->assertEquals($user->path(), "/users/{$user->id}");
    }

    /** @test */
    public function a_user_belongs_to_one_artist()
    {
        $user = factory(User::class)->states('isArtist')->create();

        $this->assertInstanceOf(Artist::class, $user->fresh()->artist);
    }
}
