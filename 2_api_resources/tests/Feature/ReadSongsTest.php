<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Song;

class ReadSongsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_fetch_all_songs()
    {
        $songs = create(Song::class, [], 2);
        
        $this->get('/songs')
            ->assertJson([ 'data' => $songs->toArray() ])
            ->assertStatus(200);
    }

    /** @test */
    public function a_user_can_fetch_a_single_song()
    {
        $song = create(Song::class);

        $this->get($song->path())
            ->assertJson([ 'data' => $song->toArray() ])
            ->assertStatus(200);
    }
}
