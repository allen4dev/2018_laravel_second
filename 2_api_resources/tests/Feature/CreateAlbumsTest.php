<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Artist;
use App\Album;

class CreateAlbumsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_artist_can_create_an_album()
    {
        $this->signin();

        $artist = create(Artist::class, [ 'user_id' => auth()->id() ]);

        $album = raw(Album::class);

        $this->post('/api/albums', $album)
            ->assertJson([ 'data' => Album::first()->toArray() ])
            ->assertStatus(201);

        $this->assertDatabaseHas('albums', [
            'artist_id' => $artist->id,
            'title'     => $album['title'],
        ]);
    }
}