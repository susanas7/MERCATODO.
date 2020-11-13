<?php

namespace Tests\Feature\Products;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aUserCanSeeDetailsOfProducts()
    {
        $product = factory(Product::class)->create();

        $response = $this->get(route('products.show', $product))
            ->assertStatus(200)
            ->assertViewIs('products.show');
    }
}
