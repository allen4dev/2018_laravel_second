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
    public function it_knows_his_path()
    {
        $artist = create(Artist::class);

        $this->assertEquals(
            $artist->path(),
            "/api/artists/{$artist->id}"
        );
    }
}
