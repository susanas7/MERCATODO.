<?php

namespace Tests\Feature\Products;

use App\Product;
use App\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aProductCanBeShown()
    {
        factory(ProductCategory::class, 50)->create();
        $product = factory(Product::class)->create();

        $response = $this->get(route('admin.products.show', $product))
            ->assertStatus(200)
            ->assertViewIs('admin.products.show');
    }
}
