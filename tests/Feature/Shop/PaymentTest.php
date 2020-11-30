<?php

namespace Tests\Feature\Shop;

use App\Order;
use App\Payment;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function payment()
    {
        /*$user = factory(User::class)->create();
        $order = factory(Order::class)->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get(route('user.checkout', $order->id));
        $response->assertRedirect();*/
    }
}
