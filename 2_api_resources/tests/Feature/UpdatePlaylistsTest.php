<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Playlist;

class UpdatePlaylistsTest extends TestCase
{
    /** @test */
    public function an_authenticated_user_can_update_his_playlist_information()
    {
        $this->signin();

        $playlist = create(Playlist::class, [ 'user_id' => auth()->id() ]);

        $updatedFields = [
            'title' => 'My updated playlist title',
            'description' => 'My updated playlist description',
        ];

        $this->patch($playlist->path(), $updatedFields)
            ->assertJson([ 'data' => $updatedFields ])
            ->assertStatus(202);

        $this->assertDatabaseHas('playlists', [
            'user_id'     => auth()->id(),
            'title'       => $updatedFields['title'],
            'description' => $updatedFields['description'],
        ]);
    }
}
