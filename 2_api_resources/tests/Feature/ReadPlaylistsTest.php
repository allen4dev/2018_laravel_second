<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Playlist;

class ReadPlaylistsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_read_all_playlists()
    {
        $playlists = create(Playlist::class, [], 2);

        $this->get('/api/playlists')
            ->assertJson([ 'data' => $playlists->toArray() ])
            ->assertStatus(200);
    }
}
