<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Album;
use App\Artist;

class DeleteAlbumsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_artist_can_delete_his_album()
    {
        $this->signin();

        $artist = create(Artist::class, [ 'user_id' => auth()->id() ]);
        $album  = create(Album::class, [ 'artist_id' => $artist->id ]);

        $this->delete($album->path())
            ->assertJson([ 'data' => $album->toArray() ])
            ->assertStatus(200);

        $this->assertDatabaseMissing('albums', [
            'title'     => $album->title,
            'artist_id' => $artist->id,
        ]);
    }
}
