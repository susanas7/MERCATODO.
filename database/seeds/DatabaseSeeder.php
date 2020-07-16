<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(ProductCategorySeeder::class);
        //$this->call(ProductSeeder::class);
        $this->call(RolesAndPermissions::class);
        $this->call(UsersSeeder::class);



    }
}
