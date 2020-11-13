<?php

namespace Tests\Feature\Roles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aRoleCanBeUpdated()
    {
        $this->artisan('db:seed');
        $permission = Permission::all()->random();
        $role = Role::all()->last();

        $response = $this->put(route('roles.update', $role), [
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
    public function aRoleCanNotBeUpdatedWithInvalidData(string $field, $value = null)
    {
        // Arrange
        $this->artisan('db:seed');
        $role = Role::all()->last();
        $data = [
            'name' => 'epsum',
            'slug' => 'Lorem ipsum dae',
        ];
        $data[$field] = $value;

        // Act
        $response = $this->put(route('roles.update', $role), $data);

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
