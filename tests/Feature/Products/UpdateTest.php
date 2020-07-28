<?php

namespace Tests\Feature\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aProductCanBeUpdated()
    {

        $product = factory(Product::class)->create();

        $this->put(route('products.show' , $product), [
            'title' =>'pan pita',
            'slug' => 'masa texturizada',
            'price' => '19',
            'category_id' =>'2',
            'img_route' => 'images/sDFKDt03wBqktBU1KYYqDcJPEPPO4bOpdD8CzK7M.jpeg'
        ]);

        $this->assertDatabaseHas('products', [
            'title' =>'pan pita',
            'slug' => 'masa texturizada',
            'price' => '19',
            'category_id' =>'2',
            'img_route' => 'images/sDFKDt03wBqktBU1KYYqDcJPEPPO4bOpdD8CzK7M.jpeg'
        ]);
        

    }

}
