<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aUserCanSeeDetailsOfProducts()
    {
        $this->withoutExceptionHandling();

        $product = factory(Product::class)->create();
        $response = $this->get(route('products.show', $product));
        $response->assertStatus(200);
        $response->assertViewIs('products.show');
    }
}
