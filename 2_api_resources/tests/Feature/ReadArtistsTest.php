<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\Artist;

class ReadArtistsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_fetch_all_artists()
    {
        $artists = create(Artist::class, [], 2);

        $response = $this->getJson('/artists')->assertStatus(200);

        $data = $response->original;

        $this->assertEquals($data, [
            'data' => Artist::all()->toArray(),
        ]);
    }
}
