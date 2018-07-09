<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Song;
use App\Artist;

class SongTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_song_knows_his_path()
    {
        $song = create(Song::class);

        $this->assertEquals($song->path(), "/songs/{$song->id}");
    }

    /** @test */
    public function a_song_belongs_to_an_artist()
    {
        $song = create(Song::class);

        $this->assertInstanceOf(Artist::class, $song->artist);
    }
}
