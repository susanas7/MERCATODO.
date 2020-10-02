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
use DB;
use Auth;
use Mockery;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function anUserCanStoreAnOrder()
    {
        $this->withoutExceptionHandling();
        /*$user = factory(User::class)->make();
        $category = factory(ProductCategory::class)->make();
        $product = factory(Product::class)->make();

        $this->actingAs($user)->get(route('shoppingCart'));

        $cart = Session::has('cart') ? Session::get('cart') : null;

        $response = $this->get('/add-to-cart/1');

        $response->assertSessionHas($cart);

        $response2 = $this->get(route('orders.store'));*/

        $product = factory(Product::class)->make();
        factory(ProductCategory::class)->make();
        $user = $this->post(route('users.store'), [
            'id' => '1',
            'name' => 'Juli',
            'email' => 'juli@mail.com',
            'password' => '12345678',
        ]);

        /*$cart = $this->actingAs($user)->get('/addToCart', [
            'id' => $product->id
        ]);*/

        //$user1 = Auth::shouldReceive('user')->andReturn($user = Mockery::mock('user'));
        //$response1 = $this->actingAs($user)->get('/shoppingCart');

        //$response1->assertSee($product->name);

        $total = $product->price;
        $quantity = '1';
        

        $order = $this->actingAs($user)->post('/orders/store', [
            'user_id' => $user->id,
            'quantity' => $quantity,
            'total' => $total,
        ]);


        $order->assertRedirect(route('orders.show'));

        $this->assertCount(1, Order::all());


    }
}