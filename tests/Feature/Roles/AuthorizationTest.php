<?php

namespace Tests\Feature\Roles;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $user;
    private $userAuth;
    private $role;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
        $this->user = factory(User::class)->create();
        $this->userAuth = factory(User::class)->create()->assignRole('Super-administrador');
        $this->role = Role::all()->first();
    }

    /** @test */
    public function anUnathorizedUserCanNotListRoles()
    {
        $response = $this->actingAs($this->user)->get(route('admin.roles.index'))
            ->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanListProducts()
    {
        $response = $this->actingAs($this->userAuth)->get(route('admin.roles.index'))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotViewTheCreateRolesForm()
    {
        $response = $this->actingAs($this->user)->get(route('admin.roles.create'))
            ->assertStatus(403);
    }

    /** @test */
    public function anAuthorizedUserCanViewTheCreateRolesForm()
    {
        $response = $this->actingAs($this->userAuth)->get(route('admin.roles.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotViewTheUpdateRolesForm()
    {
        $response = $this->actingAs($this->user)->get(route('admin.roles.edit', $this->role))
            ->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanViewTheUpdateRolesForm()
    {
        $response = $this->actingAs($this->userAuth)->get(route('admin.roles.edit', $this->role))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotDeleteARole()
    {
        $response = $this->actingAs($this->user)->get(route('admin.roles.destroy', $this->role))
            ->assertStatus(403);
    }

    /** @test */
    public function anAuthorizedUserCanDeleteARole()
    {
        $response = $this->actingAs($this->userAuth)->get(route('admin.roles.destroy', $this->role))
            ->assertStatus(200);
    }
}
