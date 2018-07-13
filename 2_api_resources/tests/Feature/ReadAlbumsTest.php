<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Album;

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
}
