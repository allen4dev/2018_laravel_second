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
            
            $this->post($user->path() . '/upgrade')
                ->assertJson([ 'data' => Artist::first()->toArray() ])
                ->assertStatus(202);
            
            $this->assertDatabaseHas('artists', [ 'user_id' => $user->id ]);
        });
    }
}
