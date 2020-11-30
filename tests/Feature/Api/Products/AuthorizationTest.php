<?php

namespace Tests\Feature\Api\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    private $user;
    private $userAuth;
    private $product;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
        $this->user = factory(User::class)->create();
        $this->userAuth = factory(User::class)
            ->create(['api_token' => Str::random(70)])
            ->assignRole('Super-administrador');
        $this->product = factory(Product::class)->create();
    }

    /** @test */
    public function anUnathorizedUserCanNotListApiProducts()
    {
        $this->actingAs($this->user)->getJson(route('api.products.index'))
            ->assertStatus(401);
    }

    /** @test */
    public function anAuthorizedUserCanListApiProducts()
    {
        $this->actingAs($this->userAuth, 'api')->getJson(route('api.products.index'), [
            'api_token' => $this->userAuth->api_token,
        ])
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotViewAnApiProduct()
    {
        $response = $this->actingAs($this->user)->getJson(route('api.products.show', $this->product))
            ->assertStatus(401);
    }

    /** @test */
    public function anAuthorizedUserCantViewAnApiProduct()
    {
        $response = $this->actingAs($this->userAuth, 'api')->getJson(route('api.products.show', $this->product), [
            'api_token' => $this->userAuth->api_token,
        ])
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotCreateAnApiProduct()
    {
        $response = $this->actingAs($this->user)->postJson(route('api.products.store'))
            ->assertStatus(401);
    }

    /** @test */
    public function anAuthorizedUserCanCreateAnApiProduct()
    {
        $data = [
            'category_id' => rand('1', '5'),
            'title' => $this->faker->sentence(2, true),
            'slug' => $this->faker->sentence(4, true),
            'is_active' => rand('0', '1'),
            'price' => rand('10', '20'),
        ];

        $response = $this->actingAs($this->userAuth, 'api')->postJson(route('api.products.store', $data), [
            'api_token' => $this->userAuth->api_token,
        ])
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotUpdateAnApiProduct()
    {
        $data = [];

        $response = $this->actingAs($this->user)->putJson(route('api.products.update', $this->product), $data)
            ->assertStatus(401);
    }

    /** @test */
    public function anAuthorizedUserCanUpdateAnApiProduct()
    {
        $data = [
            'category_id' => rand('1', '5'),
            'title' => $this->faker->sentence(2, true),
            'slug' => $this->faker->sentence(4, true),
            'is_active' => rand('0', '1'),
            'price' => rand('10', '20'),
        ];

        $response = $this->actingAs($this->userAuth, 'api')->putJson(route('api.products.update', $this->product), $data, [
            'api_token' => $this->userAuth->api_token, ])
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotDeleteAnApiProduct()
    {
        $response = $this->actingAs($this->user)->deleteJson(route('api.products.destroy',
            $this->product))->assertStatus(401);
    }

    /** @test */
    public function anAuthorizedUserCanDeleteAnApiProduct()
    {
        $response = $this->actingAs($this->userAuth)->deleteJson(route('api.products.destroy', $this->product), [
            'api_token' => $this->userAuth->api_token, ])
            ->assertStatus(200);
    }
}
