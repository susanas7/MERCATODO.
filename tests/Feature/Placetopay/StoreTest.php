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

        $order = $this->actingAs($user)->post(route('orders.store'), [
            'id' => '1',
            'user_id' => $user,
            'status' => 'creada',
            'quantity' => '3',
            'total' => '15000'
        ]);

        $response = $this->post('/checkout/1');

        $response->assertSuccessful();
    }
}
