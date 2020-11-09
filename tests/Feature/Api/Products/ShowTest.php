<?php

namespace Tests\Feature\Api\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;

class ShowTest extends TestCase
{
    //use RefreshDatabase;

    /** @test */
    public function anAPiCanShowAProduct()
    {
        $product = factory(Product::class)->create();

        $response = $this->getJson(route('api.products.show', $product));

        $response->assertJson(['id' => $product->id,'title' => $product->title])
            ->assertStatus(200);
    }
}
