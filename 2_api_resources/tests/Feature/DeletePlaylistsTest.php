<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Playlist;

class DeletePlaylistsTest extends TestCase
{
    /** @test */
    public function an_artist_can_delete_his_playlist()
    {
        $this->signin();

        $playlist = create(Playlist::class, [ 'user_id' => auth()->id() ]);

        $this->delete($playlist->path())
            ->assertJson([ 'data' => $playlist->toArray() ])
            ->assertStatus(200);

        $this->assertDatabaseMissing('playlists', [
            'user_id'    => auth()->id(),
            'title'       => $playlist->title,
            'description' => $playlist->description,
        ]);
    }
}
