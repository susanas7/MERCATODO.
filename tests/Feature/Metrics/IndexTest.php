<?php

namespace Tests\Feature\Metrics;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use App\Jobs\MetricJob;
use App\Product;
use App\Order;
use App\OrderProduct;
use DB;
use App\MetricProduct;
use App\MetricUser;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anUnauthorizedUserCanNotSeeMetrics()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('admin.metric'))
            ->assertStatus(403);
    }
    
    /** @test */
    public function anAuthorizedUserCanSeeMetricsAndJobsWorks()
    {
        $this->withoutExceptionHandling();
        $this->artisan('db:seed');
        $user = factory(User::class)->create()->assignRole('Super-administrador');
        factory(Product::class, 50)->create();
        factory(Order::class,50)->create();
        factory(OrderProduct::class, 50)->create();

        $response = $this->actingAs($user)->get(route('admin.metric'))
            ->assertOk();
        $this->assertNotNull(MetricProduct::all());
        $this->assertNotNull(MetricUser::all());
    }
}
