<?php

namespace Tests\Feature\Placetopay;

use App\Order;
use App\User;
use Mockery;
use Tests\TestCase;

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
