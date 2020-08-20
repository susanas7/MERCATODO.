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
final class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testAUserCanListProducts()
    {
        $this->withoutExceptionHandling();
        //$this->expectException(AuthenticationException::class);
        $product = factory(Product::class)->create();

        $response = $this->get(route('products.index'));
        $response->assertOk();

        $responseProducts = $response->getOriginalContent()['products'];
        $responseProducts->each(function ($item) use ($product) {
            $this->assertSame($product->id, $item->id);
        });
    }
}
