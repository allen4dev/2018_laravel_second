<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateArtistsTest extends TestCase
{
    use RefreshDatabase;

     /** @test */
    public function it_requires_a_firstname()
    {
        $this->signin();

        $this->upgradeUser(auth()->user(), [
            'firstname' => null,
        ])
        ->assertStatus(403);
    }

    public function upgradeUser($user, $data)
    {
        return $this->post("/users/{$user->id}/upgrade", $data);
    }
}
