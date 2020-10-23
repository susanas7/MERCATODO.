<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anUnathorizedUserCanNotViewTheCreateForm()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.create'));
        
        $response->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanViewTheCreateForm()
    {
        $this->artisan('db:seed');
        $user = factory(User::class)->create()->assignRole('Super-administrador');

        $response = $this->actingAs($user)->get(route('users.create'));
        
        $response->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotViewTheUpdateForm()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.create'));
        
        $response->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanViewTheUpdateForm()
    {
        $this->artisan('db:seed');
        $user = factory(User::class)->create()->assignRole('Super-administrador');
        $userB = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.edit', $userB));
        
        $response->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotListUsers()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)->get(route('users.index'));
        
        $response->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanListUsers()
    {
        $this->artisan('db:seed');
        $user = factory(User::class)->create()->assignRole('Super-administrador');
        factory(User::class, 10)->create();

        $response = $this->actingAs($user)->get(route('users.index'));
        
        $response->assertStatus(200);
    }
}
