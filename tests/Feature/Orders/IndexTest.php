<?php

namespace Tests\Feature\Orders;

use App\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    
    /** @test */
    public function aUserCanListOrders()
    {
        $order = factory(Order::class)->make();

        $response = $this->get(route('orders.index'));
        $orders = Order::all();

        $response->assertOk();
        $responseOrders = $response->getOriginalContent()['orders'];
        $responseOrders->each(function ($item) use ($order) {
            $this->assertSame($order->id, $item->id);
        });
    }
}
