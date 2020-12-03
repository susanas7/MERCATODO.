<?php

namespace Tests\Feature\Roles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function aUserCanListRoles()
    {
        $role = factory(Role::class)->create();

        $response = $this->get(route('admin.roles.index'))
            ->assertOk()
            ->assertViewis('admin.roles.index')
            ->assertSee($role->name);
    }
}
