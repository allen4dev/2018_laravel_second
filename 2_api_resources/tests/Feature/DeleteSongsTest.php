<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Artist;
use App\Song;

class DeleteSongsTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function an_artist_can_delete_a_song()
    {
        $this->signin();

        $artist = create(Artist::class, [ 'user_id' => auth()->id() ]);

        $song = create(Song::class, [ 'artist_id' => $artist->id ]);

        $this->delete($song->path())
            ->assertJson([ 'data' => $song->toArray() ])
            ->assertStatus(200);

        $this->assertDatabaseMissing('songs', [
            'artist_id' => $artist->id,
            'name'      => $song->name,
            'genre_id'  => $song->genre_id,
        ]);
    }
}
