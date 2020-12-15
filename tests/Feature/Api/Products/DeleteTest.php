<?php

namespace Tests\Feature\Api\Products;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function anApiProductCanBeDeleted()
    {
        $product = factory(Product::class)->create();

        $response = $this->deleteJson(route('api.products.destroy', $product));

        $this->assertDatabaseMissing('products', ['id'=> $product->id]);
        $this->assertCount(0, Product::all());
    }
}
