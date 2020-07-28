<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aProductCanBeCreated()
    {
        $this->withoutExceptionHandling();

        $product = factory(Product::class)->create();
        

        $this->assertDatabaseHas('products', [
            'title' => $product->title,
            'category_id' => $product->category_id,
            'slug' => $product->slug,
            'price' => $product->price,
            'updated_at' => $product->updated_at,
            'created_at' => $product->created_at,
        ]);
    }
}
