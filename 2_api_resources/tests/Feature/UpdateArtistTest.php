<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Artist;

class UpdateArtistTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_artist_can_update_his_information()
    {
        $this->signin();

        $artist = create(Artist::class, [
            'user_id'  => auth()->id(),
            'nickname' => 'Allen',
            'age'      => 23,
        ]);
        
        $this->assertDatabaseHas('artists', [
            'nickname' => $artist->nickname,
            'age' => $artist->age,
        ]);

        $newInfo = [
            'nickname' => 'My artist name',
            'age'      => 24,
        ];

        $this->patch($artist->path(), $newInfo)
            ->assertJson([ 'data' => $artist->fresh()->toArray() ])
            ->assertStatus(202);

        $this->assertDatabaseHas('artists', [
            'nickname' => $newInfo['nickname'],
            'age'      => $newInfo['age'],
            'user_id'  => auth()->id(),
        ]);
    }
}
