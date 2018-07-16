<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Artist;
use App\Album;
use App\Playlist;
use App\Song;

class AddSongToListTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_artist_can_add_a_single_song_to_his_album()
    {
        $artist = create(Artist::class);

        $album  = create(Album::class, [ 'artist_id' => $artist->id ]);
        $song   = create(Song::class,  [ 'artist_id' => $artist->id ]);

        $this->assertNull($song->album_id);

        $this->patch($album->path() . '/add-song/' . $song->id)
            ->assertJson([ 'data' => $song->fresh()->toArray() ])
            ->assertStatus(200);

        $this->assertEquals($song->fresh()->album_id, $album->id);
    }

    /** @test */
    public function an_authenticated_user_can_add_a_song_to_his_playlist()
    {
        $this->signin();

        $playlist = create(Playlist::class, [ 'user_id' => auth()->id() ]);
        $song = create(Song::class);

        $this->post($playlist->path() . '/add-song', ['songs' => [ $song->id ]])
            ->assertJson([ 'data' => [ $song->toArray() ]])
            ->assertStatus(201);

        $this->assertDatabaseHas('playlist_song', [
            'user_id'     => auth()->id(),
            'playlist_id' => $playlist->id,
            'song_id'     => $song->id,
        ]);
    }

    /** @test */
    public function an_authenticated_can_add_multiple_songs_to_his_playlist()
    {
        $this->signin();

        $playlist = create(Playlist::class, [ 'user_id' => auth()->id() ]);
        $songs = create(Song::class, [], 2);

        $this->post($playlist->path() . '/add-song', [
            'songs' => $songs->pluck('id')->toArray()
        ])
            ->assertJson([ 'data' => $songs->toArray() ])
            ->assertStatus(201);

        $songs->each(function ($song) use ($playlist) {
            $this->assertDatabaseHas('playlist_song', [
                'user_id'     => auth()->id(),
                'playlist_id' => $playlist->id,
                'song_id'     => $song->id,
            ]);
        });
    }
}
