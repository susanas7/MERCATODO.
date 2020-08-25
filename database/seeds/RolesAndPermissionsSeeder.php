<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        //create permissions
        Permission::create(['name' => 'crear usuario']);
        Permission::create(['name' => 'ver usuario']);
        Permission::create(['name' => 'editar usuario']);
        Permission::create(['name' => 'eliminar usuario']);

        Permission::create(['name' => 'crear rol']);
        Permission::create(['name' => 'ver rol']);
        Permission::create(['name' => 'editar rol']);
        Permission::create(['name' => 'eliminar rol']);

        Permission::create(['name' => 'crear permission']);
        Permission::create(['name' => 'ver permission']);
        Permission::create(['name' => 'editar permission']);
        Permission::create(['name' => 'eliminar permission']);

        Permission::create(['name' => 'crear producto']);
        Permission::create(['name' => 'ver producto']);
        Permission::create(['name' => 'editar producto']);
        Permission::create(['name' => 'eliminar producto']);

        Permission::create(['name' => 'crear categoria']);
        Permission::create(['name' => 'ver categoria']);
        Permission::create(['name' => 'editar categoria']);
        Permission::create(['name' => 'eliminar categoria']);

        //create roles and assign created permissions

        $role = Role::create(['name' => 'Gestor de usuarios', 'slug' => 'Tiene permiso para ver, editar, crear, y eliminar usuarios']);
        $role->givePermissionTo('ver usuario');
        $role->givePermissionTo('editar usuario');
        $role->givePermissionTo('crear usuario');
        $role->givePermissionTo('eliminar usuario');
        $role->givePermissionTo('ver rol');

        $role = Role::create(['name' => 'Administrador de productos', 'slug' => 'Tiene permiso para ver, editar, crear, y eliminar productos']);
        $role->givePermissionTo('crear producto');
        $role->givePermissionTo('ver producto');
        $role->givePermissionTo('editar producto');
        $role->givePermissionTo('eliminar producto');
        $role->givePermissionTo('crear categoria');
        $role->givePermissionTo('ver categoria');
        $role->givePermissionTo('editar categoria');
        $role->givePermissionTo('eliminar categoria');

        $role = Role::create(['name' => 'Super-administrador', 'slug' => 'Administrador global']);
        $role->givePermissionTo(Permission::all());
    }
}
