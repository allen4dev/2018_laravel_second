<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Artist;

class UpgradeUserTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function a_registered_user_can_upgrade_his_state_to_artist()
    {
        $this->signin();

        tap(auth()->user(), function ($user) {
            $this->assertNull($user->artist);
            
            $artistInfo = raw(Artist::class, [ 'user_id' => $user->id ]);

            $this->upgradeUser($user, $artistInfo)
                ->assertJson([ 'data' => Artist::first()->toArray() ])
                ->assertStatus(202);
            
            $this->assertDatabaseHas('artists', [ 'user_id' => $user->id ]);
        });
    }

    /** @test */
    public function it_should_be_related_to_his_artist_profile_after_become_an_artist()
    {
        $this->signin();

        $artist = raw(Artist::class, [ 'user_id' => auth()->id() ]);
        
        tap(auth()->user(), function ($user) use ($artist) {
            $this->upgradeUser($user, $artist);

            $this->assertEquals($user->fresh()->artist_id, Artist::first()->id);
        });
    }

    public function upgradeUser($user, $data)
    {
        return $this->post($user->path() . '/upgrade', $data);
    }
}
