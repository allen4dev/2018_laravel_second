<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Album;
use App\Artist;
use App\User;
use App\Song;

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

    /** @test */
    public function an_artist_response_should_contain_the_ids_of_the_songs_related_to_him()
    {
        $artist = create(Artist::class);
        $songs = create(Song::class, [ 'artist_id' => $artist->id ], 2);

        $this->get($artist->path())
            ->assertJson([
                'data' => [
                    'firstname' => $artist->firstname,
                    'lastname'  => $artist->lastname,
                    'songs'     => $songs->pluck('id')->toArray(),
                ]
            ]);
    }

    /** @test */
    public function an_artist_response_should_contain_detailed_info_about_the_songs_if_withSongs_was_passed_on_the_request()
    {
        $artist = create(Artist::class);
        $songs = create(Song::class, [ 'artist_id' => $artist->id ], 2);
        
        $this->get($artist->path() . '?withSongs')
            ->assertJson([
                'data' => [
                    'firstname' => $artist->firstname,
                    'lastname'  => $artist->lastname,
                    'songs'     => $songs->toArray(),
                ]
            ]);
    }

    /** @test */
    public function an_artist_response_should_contain_the_ids_of_the_albums_created_by_him()
    {
        $artist = create(Artist::class);

        $albums = create(Album::class, [ 'artist_id' => $artist->id ], 2);

        $this->get($artist->path())
            ->assertJson([
                'data' => [
                    'albums' => $albums->pluck('id')->toArray(),
                ]
            ]);
    }

     /** @test */
     public function an_artist_response_should_contain_detailed_info_about_the_albums_created_by_him()
     {
         $artist = create(Artist::class);
 
         $albums = create(Album::class, [ 'artist_id' => $artist->id ], 2);
 
         $this->get($artist->path() . '?withAlbums')
             ->assertJson([
                 'data' => [
                     'albums' => $albums->toArray(),
                 ]
             ]);
     }
}