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
    public function productsCanBeListed()
    {
        $product = factory(Product::class)->create();
        $products = Product::all();

        $response = $this->get(route('admin.products.index'))
            ->assertOk()
            ->assertViewis('admin.products.index')
            ->assertSee($product->title);
    }
}
