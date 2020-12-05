<?php

namespace Tests\Feature\Roles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function aUserCanSeeDetailsOfRoles()
    {
        $role = factory(Role::class)->create();
        $response = $this->get(route('admin.roles.show', $role));
        $response->assertStatus(200);
        $response->assertViewIs('admin.roles.show');
    }
}
