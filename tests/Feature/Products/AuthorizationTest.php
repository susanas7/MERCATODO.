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
        $this->user = factory(User::class)->create();
        $this->artisan('db:seed');

        $this->userAuth = factory(User::class)->create()->assignRole('Super-administrador');
        $this->product = factory(Product::class)->create();
    }

    /** @test */
    public function anUnathorizedUserCanNotViewTheCreateProductsForm()
    {
        //$user = factory(User::class)->create();
        $response = $this->actingAs($this->user)->get(route('admin.products.create'))
            ->assertStatus(403);
    }

    /** @test */
    public function anAuthorizedUserCanViewTheCreateProductsForm()
    {
        $response = $this->actingAs($this->userAuth)->get(route('admin.products.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotViewTheUpdateProductsForm()
    {
        $response = $this->actingAs($this->user)->get(route('admin.products.edit', $this->product))
            ->assertStatus(403);
    }

    /** @test */
    public function anAuthorizedUserCanViewTheUpdateProductsForm()
    {
        //$this->withoutExceptionHandling();
        $response = $this->actingAs($this->userAuth)->get(route('admin.products.edit', $this->product))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotListProducts()
    {
        $response = $this->actingAs($this->user)->get(route('admin.products.index'))
            ->assertStatus(403);
    }

    /** @test */
    public function anAuthorizedUserCanListProducts()
    {
        $response = $this->actingAs($this->userAuth)->get(route('admin.products.index'))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnauthorizedUserCanImportProducts()
    {
        //$this->withoutExceptionHandling();
        $response = $this->actingAs($this->user)->post(route('admin.products.import'))
            ->assertStatus(403);
    }
}
