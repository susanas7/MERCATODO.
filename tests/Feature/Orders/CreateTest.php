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
        $user = factory(User::class)->create();
        $category = factory(ProductCategory::class)->make();
        $product = factory(Product::class)->make();

        $response = $this->actingAs($user)->post(route('orders.store'))
            ->assertSessionHasNoErrors();

        $order = Order::first();

        $response->assertRedirect(route('orders.show', $order->id));
        $this->assertCount(1, Order::all());
    }
}
