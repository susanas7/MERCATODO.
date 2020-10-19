<?php

namespace Tests\Feature\Users;

use App\User;
use App\UserData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function aUserCanSeeDetailsOfUsers()
    {
        $this->withoutExceptionHandling();
        $userData = factory(UserData::class)->create();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.show', $user));

        $response->assertStatus(200);
        $response->assertViewIs('users.show');
        $response->assertViewHas('user', $user);
    }
}
