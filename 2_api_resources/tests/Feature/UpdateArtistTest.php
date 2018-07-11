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
            'age'      => $artist->age,
            'user_id'  => auth()->id(),
        ]);

        $newInfo = [
            'nickname' => 'My artist name',
            'age'      => 24,
        ];

        $this->updateArtistProfile($artist, $newInfo)
            ->assertJson([ 'data' => $artist->fresh()->toArray() ])
            ->assertStatus(202);

        $this->assertDatabaseHas('artists', [
            'nickname' => $newInfo['nickname'],
            'age'      => $newInfo['age'],
            'user_id'  => auth()->id(),
        ]);
    }

    /** @test */
    public function just_authorized_users_can_modifie_his_artist_profile()
    {
        $this->signin();

        $artist = create(Artist::class);

        $this->updateArtistProfile($artist, [])
            ->assertJson([
                'error' => 'You are not allowed to modify this artist.',
            ])
            ->assertStatus(403);
    }

    public function updateArtistProfile($artist, $data)
    {
        return $this->patch($artist->path(), $data);
    }
}
