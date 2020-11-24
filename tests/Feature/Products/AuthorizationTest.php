<?php

namespace Tests\Feature\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $userAuth;
    private $product;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
        $this->user = factory(User::class)->create();
        $this->userAuth = factory(User::class)->create()->assignRole('Super-administrador');
        $this->product = factory(Product::class)->create();
    }

    /** @test */
    public function anUnathorizedUserCanNotViewTheCreateProductsForm()
    {
        $response = $this->actingAs($this->user)->get(route('products.create'))
            ->assertStatus(403);
    }

    /** @test */
    public function anAuthorizedUserCanViewTheCreateProductsForm()
    {
        $response = $this->actingAs($this->userAuth)->get(route('products.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotViewTheUpdateProductsForm()
    {
        $response = $this->actingAs($this->user)->get(route('products.edit', $this->product))
            ->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanViewTheUpdateProductsForm()
    {
        $response = $this->actingAs($this->userAuth)->get(route('products.edit', $this->product))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotListProducts()
    {
        $response = $this->actingAs($this->user)->get(route('products.index'))
            ->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanListProducts()
    {
        $response = $this->actingAs($this->userAuth)->get(route('products.index'))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnauthorizedUserCanImportProducts()
    {
        $response = $this->actingAs($this->user)->post(route('products.import'))
            ->assertStatus(419);
    }
}
