<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Album;
use App\Artist;

class AlbumTest extends TestCase
{
    /** @test */
    public function it_knows_his_path()
    {
        $album = create(Album::class);

        $this->assertEquals($album->path(), "/api/albums/{$album->id}");
    }

    /** @test */
    public function it_belongs_to_an_artist()
    {
        $album = create(Album::class);

        $this->assertInstanceOf(Artist::class, $album->artist);
    }

    public function it_has_many_songs()
    {
        $album = create(Album::class);

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $album->songs
        );
    }
}
