<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Playlist;

class PlaylistTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_playlist_knows_his_path()
    {
        $playlist = create(Playlist::class);

        $this->assertEquals($playlist->path(), "/api/playlists/{$playlist->id}");
    }
}
