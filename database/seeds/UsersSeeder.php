<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
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
            'name' => 'Super admin',
            'email' => 'super.admin@mail.com',
            'password' => bcrypt('12345678'),
            //'api_token' => Str::random(50),
            'email_verified_at' => '2020-06-24 17:35:22',
        ]);

        $admin->assignRole('Super-administrador');
    }
}
