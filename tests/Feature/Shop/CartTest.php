<?php

namespace Tests\Feature\Shop;

use App\Product;
use App\ProductCategory;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function anUserCanAddAnItemToCart()
    {
        $product = factory(Product::class)->make();
        factory(ProductCategory::class)->make();
        $user = factory(User::class)->make();

        $this->actingAs($user)->get('/addToCart', [
            'id' => $product->id,
        ]);

        $response = $this->actingAs($user)->get('/shoppingCart');

        $response->assertSee($product->name);
    }

    /** @test */
    public function anUserCanRemoveAnItemFromCart()
    {
        $product1 = factory(Product::class)->make();
        $product2 = factory(Product::class)->make();
        factory(ProductCategory::class)->make();
        $user = factory(User::class)->make();
        $this->actingAs($user)->get('/addToCart', [
            'id' => $product1->id,
        ]);
        $this->actingAs($user)->get('/addToCart', [
            'id' => $product2->id,
        ]);
        $response = $this->actingAs($user)->get('/shoppingCart');
        $response->assertSee($product1->name);
        $response->assertSee($product2->name);

        $response2 = $this->actingAs($user)->get('/reduce', [
            'id' => $product1->id,
        ]);

        $response2->assertSee($product2->name);
        $response2->assertDontSeeText($product1);
    }
}
