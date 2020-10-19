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

    /**
     * @test
     */
    public function aUserCanListProducts()
    {
        $product = factory(Product::class)->make();

        $response = $this->get(route('products.index'));
        $products = Product::all();

        $response->assertOk();
        $responseProducts = $response->getOriginalContent()['products'];
        $responseProducts->each(function ($item) use ($product) {
            $this->assertSame($product->id, $item->id);
        });
    }
}
