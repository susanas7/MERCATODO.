<?php

namespace Tests\Feature\Roles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aRoleCanBeDeleted()
    {
        $this->artisan('db:seed');
        $role = Role::all()->last();

        $response = $this->delete(route('roles.destroy', $role));

        $this->assertDatabaseMissing('roles', [
            'id' => $role->id,
            'name' => $role->name,
            'guard_name' => $role->guard_name,
            'slug' => $role->slug,
            'created_at' => $role->created_at,
            'updated_at' => $role->updated_at,
        ]);
    }
}
