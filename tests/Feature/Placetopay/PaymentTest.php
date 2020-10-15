<?php

namespace Tests\Feature\Placetopay;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Order;
use Mockery;

class PaymentTest extends TestCase
{
    /** @test */
    public function payment()
    {
        $user = factory(User::class)->make();
        $order = factory(Order::class)->make();

        $placetopay = Mockery::mock('Dnetix\Redirection\PlacetoPay');
        $placetopay->shouldReceive('pay')->andReturn('isSuccessful');

    }
}
