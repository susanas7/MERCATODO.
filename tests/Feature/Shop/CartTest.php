<?php

namespace Tests\Feature\Shop;

use App\Product;
use App\ProductCategory;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $productA;
    private $productB;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
        $this->user = factory(User::class)->create();
        $this->productA = factory(Product::class)->create();
        $this->productB = factory(Product::class)->create();
    }

    /** @test */
    public function anUserCanAddAnItemToCart()
    {
        $this->get(route('user.addToCart', $this->productA->id));

        $response = $this->actingAs($this->user)->get(route('user.shoppingCart'));
        $response->assertSee($this->productA->name);
    }

    /** @test */
    public function anUserCanRemoveAnItemFromCart()
    {
        factory(ProductCategory::class)->make();

        $this->actingAs($this->user)->get(route('user.addToCart', $this->productA->id));

        $this->actingAs($this->user)->get(route('user.addToCart', $this->productB->id));

        $this->actingAs($this->user)->get(route('user.shoppingCart'))
            ->assertSee($this->productA->name)
            ->assertSee($this->productB->name);

        $response = $this->actingAs($this->user)->get(route('user.reduceByOne', $this->productA->id))
            ->assertSee($this->productB->name)
            ->assertDontSeeText($this->productA);
    }
}
