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
    public function an_authenticated_user_can_read_all_albums()
    {
        $this->signin();

        $albums = create(Album::class, [], 2);

        $this->get('/api/albums')

            ->assertJson([ 'data' => $albums->toArray() ])
            ->assertStatus(200);
    }
}
