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

    /** @test */
    public function anUserCanViewTheUpdateForm()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('editMyProfile'));

        $response->assertOk();
        $response->assertViewIs('users.editMyProfile');
    }

    /** @test */
    public function anUserCanUpdateTheirProfile()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->put(route('updateMyProfile'), [
            'name' => 'JELO',
            'email' => 'jelo@mail.com'
        ]);

        $user = User::first();

        $this->assertEquals('JELO', $user->name);
        $this->assertEquals('jelo@mail.com', $user->email);
        $response->assertRedirect('/myProfile?user=' . $user->id);
    }
}
