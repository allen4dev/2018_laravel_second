<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Playlist;
use App\Song;

class DeletePlaylistsTest extends TestCase
{
    use RefreshDatabase;

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

    /** @test */
    public function delete_a_playlist_should_clear_the_related_songs()
    {
        $this->signin();

        $playlist = create(Playlist::class, [ 'user_id' => auth()->id() ]);
        
        $song = create(Song::class);

        $this->addSongToPlaylist($playlist, $song);        

        $this->delete($playlist->path());

        $this->assertDatabaseMissing('playlist_song', [
            'playlist_id' => $playlist->id,
            'song_id' => $song->id,
        ]);
    }

    public function addSongToPlaylist($playlist, $song)
    {
        return $this->post($playlist->path() . '/add-song/' . $song->id);
    }
}
