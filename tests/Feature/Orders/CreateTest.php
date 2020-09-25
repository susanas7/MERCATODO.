<?php

namespace Tests\Feature\Orders;

use App\Order;
use App\User;
use App\Product;
use App\ProductCategory;
use App\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Session;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function carro()
    {
        //$this->withoutExceptionHandling(); ¿Por que si dejo esto me sale error?
        $user = factory(User::class)->make();
        factory(ProductCategory::class)->make();
        $product = factory(Product::class)->make();

        $this->actingAs($user)->get(route('shoppingCart'));

        $cart = Session::has('cart') ? Session::get('cart') : null;

        $response = $this->get(route('addToCart', $product->id));

        $response->assertSessionHas($cart);

        $response2 = $this->get(route('orders.store'));


    }
}
