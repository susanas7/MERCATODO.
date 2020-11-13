<?php

namespace Tests\Feature\Roles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aRoleCanBeStored()
    {
        $this->artisan('db:seed');
        $permission = Permission::all()->random();

        $response = $this->post(route('roles.store'), [
            'name' => 'administrador',
            'slug' => 'admin',
            'permissions' => $permission,
        ]);

        $role = Role::all()->last();
        $this->assertEquals($role->name, 'administrador');
        $this->assertEquals($role->slug, 'admin');
    }

    /** @test
     * @dataProvider rolesDataProvider
     * @param string $field
     * @param mixed|null $value
     */
    public function aRoleCanNotBeCreatedWithInvalidData(string $field, $value = null)
    {
        // Arrange
        $data = [
            'name' => 'epsum',
            'slug' => 'Lorem ipsum dae',
        ];
        $data[$field] = $value;

        // Act
        $response = $this->post(route('roles.store', $data));

        // Assert
        $response->assertRedirect();
        $response->assertSessionHasErrors($field);
    }

    public function rolesDataProvider(): array
    {
        return [
            'Test name is required' => ['name', null],
            'Test slug is required' => ['slug', null],
            'Test slug is too long' => ['slug', Str::random(300)],
        ];
    }
}
