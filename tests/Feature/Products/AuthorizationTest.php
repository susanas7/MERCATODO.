<?php

namespace Tests\Feature\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anUnathorizedUserCanNotViewTheCreateProductsForm()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('products.create'));

        $response->assertStatus(403);
    }

    /** @test */
    public function anAuthorizedUserCanViewTheCreateProductsForm()
    {
        $this->artisan('db:seed');
        $user = factory(User::class)->create()->assignRole('Super-administrador');

        $response = $this->actingAs($user)->get(route('products.create'));

        $response->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotViewTheUpdateProductsForm()
    {
        $user = factory(User::class)->create();
        $product = factory(Product::class)->create();

        $response = $this->actingAs($user)->get(route('products.edit', $product));

        $response->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanViewTheUpdateProductsForm()
    {
        $this->artisan('db:seed');
        $user = factory(User::class)->create()->assignRole('Super-administrador');
        $product = factory(Product::class)->create();

        $response = $this->actingAs($user)->get(route('products.edit', $product));

        $response->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotListProducts()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('products.index'));

        $response->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanListProducts()
    {
        $this->artisan('db:seed');
        $user = factory(User::class)->create()->assignRole('Super-administrador');
        factory(Product::class, 10)->create();

        $response = $this->actingAs($user)->get(route('products.index'));

        $response->assertStatus(200);
    }
}
