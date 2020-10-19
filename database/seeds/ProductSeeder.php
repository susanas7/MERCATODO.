<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = \App\ProductCategory::pluck('id');

        foreach ($categories as $categoryId) {
            factory(\App\Product::class)->times(rand(2, 6))->create([
                'category_id' => $categoryId,
            ]);
        }
    }
}
