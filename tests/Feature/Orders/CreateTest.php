<?php

namespace Tests\Feature\Orders;

use App\Order;
use App\User;
use App\Product;
use App\ProductCategory;
use App\Cart;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Session;
use DB;
use Auth;
use Mockery;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    //use WithoutMiddleware;

    /** @test */
    public function anUserCanStoreAnOrder()
    {
        //$this->withoutExceptionHandling();
        $user = factory(User::class)->make();
        $category = factory(ProductCategory::class)->make();
        $product = factory(Product::class)->make();

        /*$this->actingAs($user)->get('/addToCart', [
            'id' => $product->id
        ]);*/

        $response = $this->actingAs($user)->post(route('orders.store'))
            ->assertSessionHasNoErrors();

        //$this->assertCount(1, Order::all());

    }
}