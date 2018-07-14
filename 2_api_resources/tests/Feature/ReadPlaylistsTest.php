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

    /** @test */
    public function a_user_can_read_a_single_playlist()
    {
        $playlist = create(Playlist::class);

        $this->get($playlist->path())
            ->assertJson([ 'data' => $playlist->toArray() ])
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_can_fetch_his_playlists()
    {
        $this->signin();

        $userPlaylists = create(Playlist::class, [ 'user_id' => auth()->id() ], 2);
        $otherUserPlaylist = create(Playlist::class);

        $this->get(auth()->user()->path() . '/playlists')
            ->assertJson([ 'data' => $userPlaylists->toArray() ])
            ->assertStatus(200);
    }
}
