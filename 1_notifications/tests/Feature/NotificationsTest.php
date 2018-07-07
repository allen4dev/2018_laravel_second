<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;

class NotificationsTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function an_authenticated_user_is_notified_when_someone_follows_him()
    {
        $this->actingAs(factory(User::class)->create());

        $userFollowed = factory(User::class)->create();

        $this->follow($userFollowed);
        
        $this->assertCount(1, $userFollowed->fresh()->unreadNotifications);
    }

    /** @test */
    public function an_authenticated_user_can_mark_a_notification_as_readed()
    {
        $this->actingAs(factory(User::class)->create());

        $followedUser = factory(User::class)->create();

        $this->follow($followedUser);
        
        $this->actingAs($followedUser);

        tap(auth()->user(), function ($user) {
            $this->delete(
                "/users/{$user->id}/notifications/{$user->fresh()->unreadNotifications->first()->id}"
            );
    
            $this->assertCount(0, $user->unreadNotifications);
        });
    }

    public function follow($user)
    {
        $this->post("/users/{$user->id}/follow");

        return $user;
    }
}
