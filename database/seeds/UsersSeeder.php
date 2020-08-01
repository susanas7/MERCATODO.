<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $editor = User::create([
            'name' => 'User',
            'email' => 'admin.user@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $editor->assignRole('Gestor de usuarios');

        $moderator = User::create([
            'name' => 'Prod',
            'email' => 'admin.prod@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $moderator->assignRole('Administrador de productos');

        $admin = User::create([
            'name' => 'Auditor',
            'email' => 'auditor@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('Auditor');

        $admin = User::create([
            'name' => 'Super admin',
            'email' => 'super.admin@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('Super-administrador');
    }
}
