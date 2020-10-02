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

        $payment = Mockery::mock('Dnetix\Redirection\PlacetoPay');
        $payment->shouldReceive('request')
            ->andReturn('isSuccessful');
        
        

    }
}
