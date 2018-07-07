<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;

class UserTest extends TestCase
{
    /** @test */
    public function a_user_can_retrieve_all_users_who_he_is_following()
    {
        $user = factory(User::class)->create();

        $this->assertInstanceOf(
            'Illuminate\Database\Eloquent\Collection',
            $user->following
        );
    }
}
