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
            'name' => 'editor',
            'email' => 'editor@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $editor->assignRole('editor');

        $moderator = User::create([
            'name' => 'moderator',
            'email' => 'moderator@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $moderator->assignRole('moderator');

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('super-admin');
    }
}
