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
}
