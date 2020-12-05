<?php

namespace Tests\Feature\Orders;

use App\Order;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
        $order = factory(Order::class)->create([
            'user_id' => $user->id,
            'status' => 'created',
            'quantity' => '1',
            'total' => '20200',
        ]);

        $response = $this->actingAs($user)->get(route('admin.orders.show', $order));
        $response->assertStatus(200);
        $response->assertViewIs('admin.orders.show');
    }
}
