<?php

namespace Tests\Feature\Products;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aProductCanBeDeleted()
    {
        $product = factory(Product::class)->create();

        $this->delete(route('products.destroy', $product));

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
            'category_id' => $product->category_id,
            'title' => $product->title,
            'slug' => $product->slug,
            'is_active' => $product->is_active,
            'price' => $product->price,
            'updated_at' => $product->updated_at->toDateString(),
            'created_at' => $product->created_at->toDateString(),
            'img_route' => $product->img_route,
        ]);
    }
}
