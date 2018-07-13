<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Album;
use App\Artist;

class UpdateAlbumsTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function an_artist_can_update_his_album()
    {
        $this->signin();

        $artist = create(Artist::class, [ 'user_id' => auth()->id() ]);
        
        $album = create(Album::class, [ 'artist_id' => $artist->id ]);

        $updatedFields = [ 'title' => 'My new Album name' ];

        $this->patch($album->path(), $updatedFields)
            ->assertJson([ 'data' => $updatedFields ])
            ->assertStatus(202);

        $this->assertDatabaseHas('albums', [
            'title'     => $updatedFields['title'],
            'artist_id' => $artist->id,
        ]);
    }
}
