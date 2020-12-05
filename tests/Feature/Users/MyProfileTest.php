<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class MyProfileTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function anUserCanViewTheirProfile()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('user.myProfile'))
            ->assertSessionHasNoErrors()
            ->assertStatus(200)
            ->assertSee($user->name);
    }

    /** @test */
    public function anUserCanViewTheUpdateForm()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('user.editMyProfile'));

        $response->assertOk();
        $response->assertViewIs('user.editMyProfile');
    }

    /** @test */
    public function anUserCanUpdateTheirProfile()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->put(route('user.updateMyProfile'), [
            'name' => 'JELO',
            'email' => 'jelo@mail.com',
        ])->assertSessionHasNoErrors()
        ->assertRedirect('/user/myProfile?user=' . $user->id);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'JELO',
            'email' => 'jelo@mail.com',
        ]);
    }
}
