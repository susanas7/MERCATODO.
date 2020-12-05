<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        //$this->call(ProductCategorySeeder::class);
        //$this->call(ProductSeeder::class);
        $this->call(RolesAndPermissions::class);
        $this->call(UsersSeeder::class);
    }
}
