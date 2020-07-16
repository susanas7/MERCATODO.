<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        //create permissions
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'read user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'read role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);

        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'read permission']);
        Permission::create(['name' => 'update permission']);
        Permission::create(['name' => 'delete permission']);

        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'read product']);
        Permission::create(['name' => 'update product']);
        Permission::create(['name' => 'delete product']);

        //create roles and assign created permissions
        
        $role = Role::create(['name' => 'editor']);
        $role->givePermissionTo('read user');
        $role->givePermissionTo('update user');
        $role->givePermissionTo('read product');
        $role->givePermissionTo('update product');

        $role = Role::create(['name' => 'moderator']);
        $role->givePermissionTo('create user');
        $role->givePermissionTo('read user');
        $role->givePermissionTo('update user');
        $role->givePermissionTo('delete user');
        $role->givePermissionTo('create product');
        $role->givePermissionTo('read product');
        $role->givePermissionTo('update product');
        $role->givePermissionTo('delete product');

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());

    }
}
