<?php

namespace Tests\Feature\Orders;

use App\Order;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aUserCanSeeDetailsOfOrders()
    {
        $user = factory(User::class)->create();
        $order = factory(Order::class)->create();

        $response = $this->actingAs($user)->get(route('orders.show', $order));
        $response->assertStatus(200);
        $response->assertViewIs('orders.show');
    }
}
