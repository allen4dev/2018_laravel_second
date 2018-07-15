<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Song;
use App\Artist;
use App\Album;

class SongTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_knows_his_path()
    {
        $song = create(Song::class);

        $this->assertEquals($song->path(), "/api/songs/{$song->id}");
    }

    /** @test */
    public function it_belongs_to_an_artist()
    {
        $song = create(Song::class);

        $this->assertInstanceOf(Artist::class, $song->artist);
    }

    /** @test */
    public function it_belongs_to_an_album()
    {
        $album = create(Album::class);
        $song = create(Song::class, [ 'album_id' => $album->id ]);

        $this->assertInstanceOf(Album::class, $song->album);
    }

    /** @test */
    public function it_belongs_to_many_playlists()
    {
        $song = create(Song::class);

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $song->playlists
        );
    }
}
