<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class DeleteTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aProductCanBeDeleted()
    {
        $this->withoutExceptionHandling();
        $product = factory(Product::class)->create();

        $this->delete('products/{$product->id}');

    
       $this->assertDatabaseMissing('products', [
            'id' => $product->id,
            'category_id' => $product->category_id,
            'title' => $product->title,
            'slug' => $product->slug,
            'is_active' => $product->is_active,
            'price' => $product->price,
            'updated_at' => $product->updated_at,
            'created_at' => $product->created_at,
       ]);
    }
}
