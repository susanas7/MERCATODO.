<?php

namespace Tests\Feature\Products;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aUserCanListProducts()
    {
        $product = factory(Product::class)->create();
        $products = Product::all();

        $response = $this->get(route('products.index'))
            ->assertOk();
        $responseProducts = $response->getOriginalContent()['products']
            ->each(function ($item) use ($product) {
                $this->assertSame($product->id, $item->id);
            });
    }
}
