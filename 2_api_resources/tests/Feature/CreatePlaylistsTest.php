<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Playlist;

class CreatePlaylistsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_create_a_playlist()
    {
        $this->signin();

        $playlist = [
            'title'       => 'My new Playlist',
            'description' => 'Description of the Playlist',
        ];
        
        $this->post('/api/playlists', $playlist)
            ->assertJson([ 'data' => $playlist ])
            ->assertStatus(201);
        
        $this->assertDatabaseHas('playlists', [
            'title'       => $playlist['title'],
            'description' => $playlist['description'],
            'user_id'     => auth()->id(),
        ]);
    }
}