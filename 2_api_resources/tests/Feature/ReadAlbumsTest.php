<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Album;
use App\Artist;

class ReadAlbumsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_read_all_albums()
    {
        $albums = create(Album::class, [], 2);

        $this->get('/api/albums')
            ->assertJson([ 'data' => $albums->toArray() ])
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_can_read_a_single_album()
    {
        $album = create(Album::class);

        $this->get($album->path())
            ->assertJson([ 'data' => $album->toArray() ])
            ->assertStatus(200);
    }

    /** @test */
    public function an_artist_can_read_all_of_his_albums()
    {
        $this->signin();

        $artist = create(Artist::class, [ 'user_id' => auth()->id() ]);

        $albumsCreatedByHim = create(Album::class, [ 'artist_id' => $artist->id ], 2);
        $albumCreatedByOtherUser = create(Album::class);

        $this->get($artist->path() . '/albums')
            ->assertJson([ 'data' => $albumsCreatedByHim->toArray() ])
            ->assertStatus(200);
    }
}
