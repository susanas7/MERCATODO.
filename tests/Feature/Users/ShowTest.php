<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function anUserCanBeShown()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.show', $user))
            ->assertStatus(200)
            ->assertViewIs('users.show');
    }
}
