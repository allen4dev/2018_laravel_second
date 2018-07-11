<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Artist;
use App\User;

class DeleteArtistTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_delete_his_artist_profile()
    {
        $this->signin();

        $artist = create(Artist::class, [ 'user_id' => auth()->id() ]);
        
        $this->deleteArtistProfile($artist)
            ->assertJson([ 'data' => $artist->toArray() ])
            ->assertStatus(200);

        $this->assertDatabaseMissing('artists', [
            'user_id' => auth()->id()
        ]);
    }

    /**
     * ToDo: just_authorized_users_can_delete_his_artist_profile
     */

    /** @test */
    public function after_a_user_deletes_his_artist_profile_his_artist_relationship_should_be_clean()
    {
        $this->signin();
        
        $artist = raw(Artist::class, [ 'user_id' => auth()->id() ]);
        
        $this->post(auth()->user()->path() . '/upgrade', $artist);

        tap(auth()->user(), function ($user) {
            $this->deleteArtistProfile($user->fresh()->artist);

            $this->assertNull($user->fresh()->artist_id);
        });
    }

    public function deleteArtistProfile($artist)
    {
        return $this->delete($artist->path());
    }
}
