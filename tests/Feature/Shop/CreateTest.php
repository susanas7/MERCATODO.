<?php

namespace Tests\Feature\Shop;

use App\Order;
use App\Product;
use App\ProductCategory;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function anUserCanStoreAnOrder()
    {
        $user = factory(User::class)->create();
        $category = factory(ProductCategory::class)->make();
        $product = factory(Product::class)->make();

        $response = $this->actingAs($user)->post(route('user.store.order'))
            ->assertSessionHasNoErrors();

        $order = Order::first();

        $this->assertCount(1, Order::all());
    }
}
