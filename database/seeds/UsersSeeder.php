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
            'name' => 'Admin user',
            'email' => 'admin.user@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $editor->assignRole('Administrador de usuarios');

        $moderator = User::create([
            'name' => 'Admin prod',
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

        $admin->assignRole('SUper-administrador');
    }
}
