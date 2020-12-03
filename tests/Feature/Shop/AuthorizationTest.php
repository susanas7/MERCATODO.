<?php

namespace Tests\Feature\Shop;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $product;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:refresh --seed');
        $this->user = factory(User::class)->create();
        $this->product = factory(Product::class)->create();
    }

    /** @test */
    public function anUnauthenticatedUserCanNotAddAnItemToCart()
    {
        $this->get(route('user.addToCart', $this->product->id))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function anAuthenticatedUserCanAddAnItemToCart()
    {
        $this->actingAs($this->user)->get(route('user.addToCart', $this->product->id));

        $response = $this->actingAs($this->user)->get(route('user.shoppingCart'));
        $response->assertSee($this->product->name);
    }

    /** @test */
    public function anUnauthenticatedUserCanNotSeeCart()
    {
        $response = $this->get(route('user.shoppingCart'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function anAuthenticatedUserCanSeeCart()
    {
        $response = $this->actingAs($this->user)->get(route('user.shoppingCart'))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnauthenticatedUserCanNotRemoveAnItemToCart()
    {
        $response = $this->get(route('user.reduceByOne', $this->product))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }

    /** @test */
    public function anAuthenticatedUserCanRemoveAnItemToCart()
    {
        $this->actingAs($this->user)->get(route('user.addToCart', $this->product->id));

        $response = $this->actingAs($this->user)->get(route('user.reduceByOne', $this->product->id))
            ->assertRedirect();
    }

    /** @test */
    public function anUnauthenticatedUserCanStoreAnOrder()
    {
        $response = $this->post(route('user.store.order'))
            ->assertStatus(302)
            ->assertRedirect(route('login'));
    }
}
