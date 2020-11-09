<?php

namespace Tests\Feature\Api\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anApiProductCanBeDeleted()
    {
        //Arrange
        $product = factory(Product::class)->create();

        //Act
        $response = $this->deleteJson(route('api.products.destroy', $product));

        //Assert
        $this->assertDatabaseMissing('products', ['id'=> $product->id]);
        $this->assertCount(0, Product::all());
    }
}
