<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Artist;
use App\Album;
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
}
