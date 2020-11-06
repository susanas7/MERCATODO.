<?php

namespace Tests\Feature\Api\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function canStoreAProductFromApi()
    {
        $this->withoutExceptionHandling();
        //Arrange
        $data = [
            'category_id' => rand('1', '5'),
            'title' => $this->faker->sentence(2, true), 
            'slug' => $this->faker->sentence(4, true), 
            'is_active' => rand('0', '1'),
            'price' => rand('10', '20'),
        ];

        //Act
        $response = $this->postJson(route('api.products.store', $data))
            ->assertOk();

        //Assert
        $product = Product::first();
        $this->assertDatabaseHas('products', [
            'category_id' => $product->category_id,
            'title' => $product->title,
            'slug' => $product->slug,
            'is_active' => $product->is_active,
            'price' => $product->price,
        ]);
    }
}
