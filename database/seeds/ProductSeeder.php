<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

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
