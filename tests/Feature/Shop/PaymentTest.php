<?php

namespace Tests\Feature\Shop;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Order;
use App\User;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function payment()
    {
        $user = factory(User::class)->create();
        $order = factory(Order::class)->create([
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get(route('checkout', $order))
            ->assertRedirect();
    }
}
