<?php

namespace Tests\Feature\Roles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

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
        $response = $this->actingAs($this->user)->get(route('roles.index'))
            ->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanListProducts()
    {
        $response = $this->actingAs($this->userAuth)->get(route('roles.index'))
            ->assertStatus(200);
    }
    
    /** @test */
    public function anUnathorizedUserCanNotViewTheCreateRolesForm()
    {
        $response = $this->actingAs($this->user)->get(route('roles.create'))
            ->assertStatus(403);
    }

    /** @test */
    public function anAuthorizedUserCanViewTheCreateRolesForm()
    {
        $response = $this->actingAs($this->userAuth)->get(route('roles.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotViewTheUpdateRolesForm()
    {
        $response = $this->actingAs($this->user)->get(route('roles.edit', $this->role))
            ->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanViewTheUpdateRolesForm()
    {
        $response = $this->actingAs($this->userAuth)->get(route('roles.edit', $this->role))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotDeleteARole()
    {
        $response = $this->actingAs($this->user)->get(route('roles.destroy', $this->role))
            ->assertStatus(403);
    }

    /** @test */
    public function anAuthorizedUserCanDeleteARole()
    {
        $response = $this->actingAs($this->userAuth)->get(route('roles.destroy', $this->role))
            ->assertStatus(200);
    }
}
