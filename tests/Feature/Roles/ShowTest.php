<?php

namespace Tests\Feature\Roles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aUserCanSeeDetailsOfRoles()
    {
        $this->withoutExceptionHandling();

        $role = factory(Role::class)->create();
        $response = $this->get(route('roles.show', $role));
        $response->assertStatus(200);
        $response->assertViewIs('roles.show');
    }
}
