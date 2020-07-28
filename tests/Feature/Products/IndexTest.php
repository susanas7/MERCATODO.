<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function testExample()
    {
        $this->withoutExceptionHandling();
        //$this->expectException(AuthenticationException::class);
        $product = factory(Product::class)->create();

        $response = $this->get(route('products.index'));
        $response->assertOk();

        $responseProducts = $response->getOriginalContent()['products'];
        $responseProducts->each(function($item) use ($product) {
            $this->assertEquals($product->id, $item->id);
        });
    }
}
