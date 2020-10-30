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
    public function anUnathorizedUserCanNotViewTheCreateForm()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('products.create'));

        $response->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanViewTheCreateForm()
    {
        $this->artisan('db:seed');
        $user = factory(User::class)->create()->assignRole('Super-administrador');

        $response = $this->actingAs($user)->get(route('products.create'));

        $response->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotViewTheUpdateForm()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('products.create'));

        $response->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanViewTheUpdateForm()
    {
        $this->artisan('db:seed');
        $user = factory(User::class)->create()->assignRole('Super-administrador');
        $product = factory(Product::class)->create();

        $response = $this->actingAs($user)->get(route('products.edit', $product));

        $response->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotListCategories()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('products.index'));

        $response->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanListCategories()
    {
        $this->artisan('db:seed');
        $user = factory(User::class)->create()->assignRole('Super-administrador');
        factory(Product::class, 10)->create();

        $response = $this->actingAs($user)->get(route('products.index'));

        $response->assertStatus(200);
    }
}
