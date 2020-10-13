<?php

namespace Tests\Feature\Placetopay;

use App\Order;
use App\User;
use Session;
use Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Contracts\Auth\Authenticatable;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function pago()
    {
        $this->withoutExceptionHandling();
        $user = $this->post(route('users.store'), [
            'id' => '1',
            'name' => 'Juli',
            'email' => 'juli@mail.com',
            'password' => '12345678',
        ]);

        /*$order = $this->post(route('orders.store'), [
            'id' => '1',
            'user_id' => '1',
            'status' => 'creada',
            'quantity' => '3',
            'total' => '15000'
        ]);*/

        $order = factory(Order::class)->make();


        $this->assertDatabaseMissing('orders', [
            'id' => $order->id,
            'user_id' => $order->user_id,
            'quantity' => $order->quantity,
            'total' => $order->total,
            'created_at' => $order->created_at,
            'updated_at' => $order->updated_at,
        ]);

        //$this->post('checkout/'.$order->id); completar


        //$response->assertSuccessful();
    }
}
