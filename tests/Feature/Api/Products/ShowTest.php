<?php

namespace Tests\Feature\Api\Products;

use App\Product;
use App\User;
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
        //Arrange
        $this->artisan('db:seed');
        $product = factory(Product::class)->create();
        $userAuth = factory(User::class)->create()->assignRole('Super-administrador');

        //Act
        $response = $this->actingAs($userAuth)->getJson(route('api.products.show', $product));

        //dd($response->json());
        //Assert
        $response->assertJson([
            'product' => [
                'id' => $product->id,
                'category_id' => $product->category_id,
                'title' => $product->title,
                'slug' => $product->slug,
                'is_active' => $product->is_active,
                'price' => $product->price,
            ]
        ])
            ->assertStatus(200);
    }
}
