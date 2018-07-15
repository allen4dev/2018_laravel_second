<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Album;
use App\Artist;
use App\Song;
use App\Playlist;

class RemoveSongFromListTest extends TestCase
{
    use RefreshDatabase;

   /** @test */
    public function an_artist_can_remove_a_song_from_his_album()
    {
        $artist = create(Artist::class);

        $album  = create(Album::class, [ 'artist_id' => $artist->id ]);
        $song   = create(Song::class, [
            'artist_id' => $artist->id,
            'album_id' => $album->id,
        ]);

        $this->delete($album->path() . '/remove-song/' . $song->id)
            ->assertJson([ 'data' => [
                'name'      => $song->name,
                'artist_id' => $artist->id,
                'album_id'  => null
            ] ])
            ->assertStatus(200);

        $this->assertNull($song->fresh()->album_id);
    }

    /** @test */
    public function an_authenticated_user_can_remove_a_song_from_his_playlist()
    {
        $this->signin();

        $playlist = create(Playlist::class, [ 'user_id' => auth()->id() ]);
        
        $song = create(Song::class);
        $this->post($playlist->path() . '/add-song/' . $song->id);

        $this->delete($playlist->path() . '/remove-song/' . $song->id)
            ->assertJson([ 'data' => $song->toArray() ])
            ->assertStatus(200);

        $this->assertDatabaseMissing('playlist_song', [
            'playlist_id' => $playlist->id,
            'song_id' => $song->id,
            'user_id' => auth()->id(),
        ]);
    }
}
