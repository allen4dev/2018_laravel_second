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

        $this->getJson('/api/artists')
            ->assertJson([ 'data' => Artist::all()->toArray() ])
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_can_fetch_a_single_artist()
    {
        $artist = create(Artist::class);

        $this->get($artist->path())
            ->assertJson([ 'data' => $artist->toArray() ])
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_receive_the_number_of_results_he_wants()
    {
        $artists = create(Artist::class, [], 2);

        $this->get('/api/artists?offset=1')
            ->assertJson([
                'data' => [ $artists->first()->toArray() ],
                'meta' => [
                    'current_page' => 1,
                    'total' => 2
                ]
            ]);
    }

    /** @test */
    public function response_should_contain_meta_information()
    {
        $artists = create(Artist::class, [], 2);

        $this->get('/api/artists')
            ->assertJson([ 'meta' => [
                'status' => 200,
            ]]);
    }
}