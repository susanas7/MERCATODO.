<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use App\User;
use Illuminate\Database\Seeder;

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
        ]);

        $admin->assignRole('Super-administrador');
    }
}
