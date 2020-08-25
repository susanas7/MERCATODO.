<?php

namespace Tests\Feature\Products;

use App\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function aProductCanBeUpdated()
    {
        $product = factory(Product::class)->create();

        $response = $this->put(route('products.update', $product), [
            'title' => 'Agua',
            'slug' => 'lorem ipsum etc',
            'price' => '32444',
            'category_id' => '1',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);
        $product = Product::first();

        $this->assertEquals('Agua', $product->title);
        $this->assertEquals('lorem ipsum etc', $product->slug);
        $this->assertEquals('1', $product->category_id);
        $this->assertEquals('32444', $product->price);
        $this->assertEquals('images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg', $product->img_route);
        $response->assertRedirect(route('products.index'));
    }

    /**
     * @test
     */
    public function aProductCanNotBeUpdatedWithEmptyTitle()
    {
        $response = $this->post(route('products.store'), [
            'title' => 'Agua',
            'slug' => 'lorem ipsum etc',
            'category_id' => '1',
            'price' => '32444',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);

        $product = Product::first();

        $response2 = $this->put(route('products.update', $product), [
            'title' => '',
            'slug' => 'lorem ipsum etc',
            'category_id' => '1',
            'price' => '32444',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);

        $this->assertCount(1, Product::all());

        $this->assertEquals('Agua', $product->title);
        $this->assertEquals('lorem ipsum etc', $product->slug);
        $this->assertEquals('1', $product->category_id);
        $this->assertEquals('32444', $product->price);
        $this->assertEquals('images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg', $product->img_route);
        $response->assertRedirect(route('products.index'));
    }

    /**
     * @test
     */
    public function aProductCanNotBeUpdatedWithEmptySlug()
    {
        $response = $this->post(route('products.store'), [
            'title' => 'Agua',
            'slug' => 'lorem ipsum etc',
            'category_id' => '1',
            'price' => '32444',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);

        $product = Product::first();

        $response2 = $this->put(route('products.update', $product), [
            'title' => 'Agua',
            'slug' => '',
            'category_id' => '1',
            'price' => '32444',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);

        $this->assertCount(1, Product::all());

        $this->assertEquals('Agua', $product->title);
        $this->assertEquals('lorem ipsum etc', $product->slug);
        $this->assertEquals('1', $product->category_id);
        $this->assertEquals('32444', $product->price);
        $this->assertEquals('images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg', $product->img_route);
        $response->assertRedirect(route('products.index'));
    }

    /**
     * @test
     */
    public function aProductCanNotBeUpdatedWithEmptyCategory()
    {
        $response = $this->post(route('products.store'), [
            'title' => 'Agua',
            'slug' => 'lorem ipsum etc',
            'category_id' => '1',
            'price' => '32444',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);

        $product = Product::first();

        $response2 = $this->put(route('products.update', $product), [
            'title' => '',
            'slug' => 'lorem ipsum etc',
            'category_id' => '',
            'price' => '32444',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);

        $this->assertCount(1, Product::all());

        $this->assertEquals('Agua', $product->title);
        $this->assertEquals('lorem ipsum etc', $product->slug);
        $this->assertEquals('1', $product->category_id);
        $this->assertEquals('32444', $product->price);
        $this->assertEquals('images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg', $product->img_route);
        $response->assertRedirect(route('products.index'));
    }

    /**
     * @test
     */
    public function aProductCanNotBeUpdatedWithEmptyPrice()
    {
        $response = $this->post(route('products.store'), [
            'title' => 'Agua',
            'slug' => 'lorem ipsum etc',
            'category_id' => '1',
            'price' => '32444',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);

        $product = Product::first();

        $response2 = $this->put(route('products.update', $product), [
            'title' => '',
            'slug' => 'lorem ipsum etc',
            'category_id' => '1',
            'price' => '',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);

        $this->assertCount(1, Product::all());

        $this->assertEquals('Agua', $product->title);
        $this->assertEquals('lorem ipsum etc', $product->slug);
        $this->assertEquals('1', $product->category_id);
        $this->assertEquals('32444', $product->price);
        $this->assertEquals('images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg', $product->img_route);
        $response->assertRedirect(route('products.index'));
    }
}
