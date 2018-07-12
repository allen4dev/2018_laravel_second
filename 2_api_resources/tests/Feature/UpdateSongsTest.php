<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Artist;
use App\Song;

class UpdateSongsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_artist_can_update_a_song()
    {
        $artist = create(Artist::class);

        $song   = create(Song::class, [ 'artist_id' => $artist->id ]);

        $updatedFields = [
            'name'     => 'My new song name',
            'genre_id' => 999,
        ];

        $this->patch($song->path(), $updatedFields)
            ->assertJson([ 'data' => $updatedFields ])
            ->assertStatus(202);

        $this->assertDatabaseHas('songs', [
            'artist_id' => $artist->id,
            'genre_id'  => $updatedFields['genre_id'],
            'name'      => $updatedFields['name'],
        ]);
    }
}
