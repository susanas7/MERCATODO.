<?php

namespace Tests\Feature\Api\Products;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    private $product;
    private $products;

    public function setUp(): void
    {
        parent::setUp();
        $this->product = factory(Product::class)->create();
        $this->products = factory(Product::class, 14)->create();
    }

    /** @test */
    public function apiReturnsAJsonResponse()
    {
        //Act & Assert
        $response = $this->getJson(route('api.products.index'))
            ->assertStatus(200)->assertJsonStructure(['data']);
    }

    /** @test */
    public function jsonResponseHasAnArrayWithCorrectData()
    {
        //Act
        $response = $this->getJson(route('api.products.index'));

        //Assert
        $response->assertStatus(200)->assertJson([
            'data' => [
                [
                    'id' => $this->product->id,
                    'category_id' => $this->product->category_id,
                    'title' => $this->product->title,
                    'slug' => $this->product->slug,
                    'is_active' => $this->product->is_active,
                    'price' => $this->product->price,
                    'created_at' => $this->product->created_at->toDateString(),
                ],
            ],
        ]);
    }

    /** @test */
    public function jsonResponseIsPaginated()
    {
        //Arrange
        $productB = factory(Product::class)->create();

        //Act
        $response = $this->getJson(route('api.products.index', ['page' => 2]));

        //Assert
        $response->assertJsonMissing([
            'data' => [
                [
                    'id' => $this->product->id,
                ],
            ],
        ]);

        $response->assertJson([
            'data' => [
                [
                    'id' => $productB->id,
                ],
            ],
        ]);
    }
}
