<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemoveSongFromList extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_artist_can_remove_a_song_from_his_album()
    {
        // Given we have an artist
        $artist = create(Artist::class);
        // an album created by him and a song from that album
        $album  = create(Album::class, [ 'artist_id' => $artist->id ]);
        $song   = create(Song::class, [
            'artist_id' => $artist->id,
            'album_id' => $album->id,
        ]);

        // When he makes a DELETE request to album->path()/remove-song/{song}
        $this->delete($album->path() . '/remove-song/' . $song->id)

        // Then he should receive a JSON withe the deleted song
            ->assertJson([ 'data' => [
                'name'      => $song->name,
                'artist_id' => $artist->id,
                'album_id'  => null
            ] ])
        // and a 200 status code
            ->assertStatus(200);

        // also the album_id field of the song should be null
        $this->assertNull($song->fresh()->album_id);
    }
}
