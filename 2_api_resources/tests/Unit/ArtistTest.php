<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Artist;
use App\User;

class ArtistTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_knows_his_path()
    {
        $artist = create(Artist::class);

        $this->assertEquals(
            $artist->path(),
            "/api/artists/{$artist->id}"
        );
    }

    /** @test */
    public function it_has_many_albums()
    {
        $artist = create(Artist::class);

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $artist->albums
        );
    }
}
