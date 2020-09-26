<?php

namespace Tests\Feature\Shop;

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

class CartTest extends TestCase
{
    /** @test */
    public function aUserCanAddAnItemToCart()
    {
        //$this->withoutExceptionHandling(); aqui pasa lo mismo,

        Session::start();
        $user = factory(User::class)->make();
        factory(ProductCategory::class)->make();
        $product = factory(Product::class)->make();

        $this->actingAs($user)->get(route('shoppingCart'));

        $cart = Session::get('cart');
        //$cart->add($product, $product->id);

        $response = $this->get('/add-to-cart/1')->assertSessionHas($cart);

        //$this->assertEquals($cart->product->id, $product->id);
    }
}
