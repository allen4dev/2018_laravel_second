<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Artist;

class ArtistTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_artist_knows_his_path()
    {
        $artist = create(Artist::class);

        $this->assertEquals(
            $artist->path(),
            "/artists/{$artist->id}"
        );
    }
}
