<?php

namespace Tests\Feature\Roles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aUserCanListRoles()
    {
        $this->withoutExceptionHandling();

        $role = factory(Role::class)->create();

        $response = $this->get(route('roles.index'));
        $response->assertOk();
        $responseRoles = $response->getOriginalContent()['roles'];
        $responseRoles->each(function($item) use ($role) {
            $this->assertEquals($role->id, $item->id);
        });
    }
}
