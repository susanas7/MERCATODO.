<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $userAuth;
    private $users;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
        $this->user = factory(User::class)->create();
        $this->userAuth = factory(User::class)->create()->assignRole('Super-administrador');
    }

    /** @test */
    public function anUnathorizedUserCanNotListUsers()
    {
        $response = $this->actingAs($this->user)->get(route('users.index'))
            ->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanListUsers()
    {
        $response = $this->actingAs($this->userAuth)->get(route('users.index'))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotViewTheCreateUsersForm()
    {
        $response = $this->actingAs($this->user)->get(route('users.create'))
            ->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanViewTheCreateUsersForm()
    {
        $response = $this->actingAs($this->userAuth)->get(route('users.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotViewTheUpdateUsersForm()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.edit', $user))
            ->assertStatus(403);
    }

    /** @test */
    public function anAuthorizedUserCanViewTheUpdateUsersForm()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($this->userAuth)->get(route('users.edit', $user))
            ->assertStatus(200);
    } 
}
