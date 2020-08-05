<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tests\Feature\Products;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testAProductCanBeUpdated()
    {
        $product = factory(Product::class)->create();

        $this->put(route('products.update', $product), [
            'title' => 'pan pita',
            'slug' => 'masa texturizada',
            'price' => '19',
            'category_id' => '2',
            'img_route' => 'images/sDFKDt03wBqktBU1KYYqDcJPEPPO4bOpdD8CzK7M.jpeg',
        ]);

        $this->assertDatabaseHas('products', [
            'title' => 'pan pita',
            'slug' => 'masa texturizada',
            'price' => '19',
            'category_id' => '2',
            'img_route' => 'images/sDFKDt03wBqktBU1KYYqDcJPEPPO4bOpdD8CzK7M.jpeg',
        ]);
    }
}
