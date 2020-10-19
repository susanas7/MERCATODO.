<?php

namespace Tests\Feature\Products;

use App\Product;
use App\User;
use App\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function aUserCanViewTheProductCreateForm()
    {
        $product = factory(Product::class)->create();

        $response = $this->get(route('products.create'));

        $response->assertOk();
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function aUserCanStoreAProduct()
    {
        $category = factory(ProductCategory::class)->create();

        $response = $this->post(route('products.store'), [
            'title' => 'Agua',
            'slug' => 'lorem ipsum etc',
            'category_id' => '1',
            'price' => '32444',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);

        $product = Product::first();
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
    public function aProductCanNotBeStoredWithEmptyTitle()
    {
        $product = $this->post(route('products.store'), [
            'title' => '',
            'slug' => 'lorem ipsum etc',
            'category_id' => '1',
            'price' => '32444',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);

        $this->assertCount(0, Product::all());
    }

    /**
     * @test
     */
    public function aProductCanNotBeStoredWithEmptySlug()
    {
        $product = $this->post(route('products.store'), [
            'title' => 'Agua',
            'slug' => '',
            'category_id' => '1',
            'price' => '32444',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);

        $this->assertCount(0, Product::all());
    }

    /**
     * @test
     */
    public function aProductCanNotBeStoredWithEmptyCategory()
    {
        $product = $this->post(route('products.store'), [
            'title' => 'Agua',
            'slug' => 'lorem ipsum etc',
            'category_id' => '',
            'price' => '32444',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);

        $this->assertCount(0, Product::all());
    }

    /**
     * @test
     */
    public function aProductCanNotBeStoredWithEmptyPrice()
    {
        $product = $this->post(route('products.store'), [
            'title' => 'Agua',
            'slug' => 'lorem ipsum etc',
            'category_id' => '1',
            'price' => '',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);

        $this->assertCount(0, Product::all());
    }

    /**
     * @test
     */
    public function aProductCanNotBeStoredWithInvalidSlug()
    {
        $product = $this->post(route('products.store'), [
            'title' => 'Agua',
            'slug' => 'lorem ipsum etc ehshh agsj ahsuuu ajsue ajdh ays hejja sy ejdhahhyedhah dggajd agjdg asgas hahaha hsuuenmdimn uauus uauusujsujsu uujsn dd hj hahaha ujsu e8u oif syduaidy ia duiyud yiud iuay odsgbdljsg ok',
            'category_id' => '1',
            'price' => '32444',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);

        $this->assertCount(0, Product::all());
    }

    /**
     * @test
     */
    public function aProductCanNotBeStoredWithInvalidPrice()
    {
        $product = $this->post(route('products.store'), [
            'title' => 'Agua',
            'slug' => 'lorem ipsum etc',
            'category_id' => '1',
            'price' => 'husme',
            'img_route' => 'images/MfV3Uh8O9EBy7gfFBGhNMiCYQwnE1FA91irNMdim.jpeg'
        ]);

        $this->assertCount(0, Product::all());
    }
}
