<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Artist;
use App\Song;

class CreateSongsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_artist_can_create_songs()
    {
        $artist = create(Artist::class);

        $song = raw(Song::class, [ 'artist_id' => $artist->id ]);

        $this->post('/api/songs', $song)
            ->assertJson([ 'data' => Song::first()->toArray() ])
            ->assertStatus(201);

        $this->assertDatabaseHas('songs', [
            'artist_id' => $artist->id,
            'name' => $song['name'],
        ]);
    }
}
