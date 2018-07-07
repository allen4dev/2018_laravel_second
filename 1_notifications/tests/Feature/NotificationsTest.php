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

        $this->post("/users/{$userFollowed->id}/follow");
        
        $this->assertCount(1, $userFollowed->fresh()->unreadNotifications);
    }
}
