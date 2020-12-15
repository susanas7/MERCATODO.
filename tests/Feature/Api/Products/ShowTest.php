<?php

namespace Tests\Feature\Api\Products;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function anApiCanShowAProduct()
    {
        $product = factory(Product::class)->create();

        $response = $this->getJson(route('api.products.show', $product));

        $response->assertJson([
            'product' => [
                'id' => $product->id,
                'category_id' => $product->category_id,
                'title' => $product->title,
                'slug' => $product->slug,
                'is_active' => $product->is_active,
                'price' => $product->price,
            ],
        ])
            ->assertStatus(200);
    }
}
