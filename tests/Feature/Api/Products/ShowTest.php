<?php

namespace Tests\Feature\Api\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Product;
use App\User;

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

        //Assert
        $response->assertJson(['id' => $product->id,'title' => $product->title])
            ->assertStatus(200);
    }
}
