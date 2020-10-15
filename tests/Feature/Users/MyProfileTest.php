<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\User;

class MyProfileTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function anUserCanViewTheirProfile()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('myProfile'))
            ->assertSessionHasNoErrors()
            ->assertStatus(200)
            ->assertSee($user->name);
    }
}
