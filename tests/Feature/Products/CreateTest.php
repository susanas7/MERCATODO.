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
final class CreateTest extends TestCase
{
    //use RefreshDatabase;
    use WithoutMiddleware;

    public function aProductCanBeCreated()
    {
        $this->withoutExceptionHandling();

        $product = factory(Product::class)->create();

        $this->assertDatabaseHas('products', [
            'title' => $product->title,
            'category_id' => $product->category_id,
            'slug' => $product->slug,
            'price' => $product->price,
            'updated_at' => $product->updated_at,
            'created_at' => $product->created_at,
            'img_route' => $product->img_route,
        ]);
    }
}
