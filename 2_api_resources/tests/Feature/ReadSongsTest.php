<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Album;
use App\Artist;
use App\Playlist;
use App\Song;

class ReadSongsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_fetch_all_songs()
    {
        $songs = create(Song::class, [], 2);
        
        $this->get('/api/songs')
            ->assertJson([ 'data' => $songs->toArray() ])
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_can_fetch_a_single_song()
    {
        $song = create(Song::class);

        $this->get($song->path())
            ->assertJson([ 'data' => $song->toArray() ])
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_can_fetch_all_songs_of_an_artist()
    {
        $artist = create(Artist::class);

        $songsCreatedByHim = create(Song::class, [ 'artist_id' => $artist->id ], 2);
        $songCreatedByOtherArtist = create(Song::class);
        
        $this->get($artist->path() . '/songs')
            ->assertJson([ 'data' => $songsCreatedByHim->toArray() ])
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_can_fetch_all_songs_of_an_album()
    {
        $album = create(Album::class);

        $albumSongs = create(Song::class, [ 'album_id' => $album->id ], 2);
        $songForOtherAlbum = create(Song::class);

        $this->get($album->path() . '/songs')
            ->assertJson([ 'data' => $albumSongs->toArray() ])
            ->assertStatus(200);
    }

    /** 
     * ToDo: a_user_can_fetch_all_songs_of_a_playlist
    */
    // public function a_user_can_fetch_all_songs_of_a_playlist()
    // {
        // Given we have a playlist

        // two songs for that playlist and a song for other playlist

        // When a user makes a GET request to the $playlist->path/songs

        // Then he should receive a JSON with the playlist songs
        // and a 200 OK status code
    // }
}
