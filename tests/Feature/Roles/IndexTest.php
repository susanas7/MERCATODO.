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
        $this->withoutExceptionHandling();

        $role = factory(Role::class)->create();

        $response = $this->get(route('admin.roles.index'));
        $response->assertOk();
        $responseRoles = $response->getOriginalContent()['roles'];
        $responseRoles->each(function ($item) use ($role) {
            $this->assertSame($role->id, $item->id);
        });
    }
}
