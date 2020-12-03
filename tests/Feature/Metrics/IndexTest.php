<?php

namespace Tests\Feature\Metrics;

use App\MetricProduct;
use App\MetricUser;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
        $this->artisan('migrate:refresh --seed');
        $user = factory(User::class)->create()->assignRole('Super-administrador');

        $response = $this->actingAs($user)->get(route('admin.metric'))
            ->assertOk();
        $this->assertNotNull(MetricProduct::all());
        $this->assertNotNull(MetricUser::all());
    }
}
