<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;

class FollowUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_follow_other_users()
    {
        $this->actingAs(factory(User::class)->create());

        $userToFollow = factory(User::class)->create();

        $this->post("/users/{$userToFollow->id}/follow");

        $this->assertDatabaseHas('follows', [
            'user_id'   => auth()->id(),
            'follow_id' => $userToFollow->id,
        ]);
    }

    /** @test */
    public function after_follow_a_user_a_new_record_should_be_created_in_the_followers_table()
    {
        $this->actingAs(factory(User::class)->create());

        $user = factory(User::class)->create();

        $this->follow($user);
        
        $this->assertDatabaseHas('followers', [
            'user_id'     => $user->id,
            'follower_id' => auth()->id(),
        ]);

        $this->assertCount(1, $user->followers);
    }

    public function follow($user)
    {
        $this->post("/users/{$user->id}/follow");

        return $user;
    }
}
