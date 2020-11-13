<?php

namespace Tests\Feature\Api\Products;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $this->userAuth = factory(User::class)->create()->assignRole('Super-administrador');
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
        //Act & Assert
        $this->actingAs($this->userAuth, 'api')->getJson(route('api.products.index'), [
            'api_token' => $this->userAuth->api_token,
        ])
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotViewAnApiProduct()
    {
        //Act & Assert
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
        //Act & Assert
        $response = $this->actingAs($this->user)->postJson(route('api.products.store'))
            ->assertStatus(401);
    }

    /** @test */
    public function anAuthorizedUserCanCreateAnApiProduct()
    {
        //Arrange
        $data = [
            'category_id' => rand('1', '5'),
            'title' => $this->faker->sentence(2, true),
            'slug' => $this->faker->sentence(4, true),
            'is_active' => rand('0', '1'),
            'price' => rand('10', '20'),
        ];

        //Act & Assert
        $response = $this->actingAs($this->userAuth, 'api')->postJson(route('api.products.store', $data), [
            'api_token' => $this->userAuth->api_token,
        ])
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotUpdateAnApiProduct()
    {
        //Arrange
        $data = [];

        //Act & Assert
        $response = $this->actingAs($this->user)->putJson(route('api.products.update', $this->product), $data)
            ->assertStatus(401);
    }

    /** @test */
    public function anAuthorizedUserCanUpdateAnApiProduct()
    {
        //Arrange
        $data = [
            'category_id' => rand('1', '5'),
            'title' => $this->faker->sentence(2, true),
            'slug' => $this->faker->sentence(4, true),
            'is_active' => rand('0', '1'),
            'price' => rand('10', '20'),
        ];

        //Act & Assert
        $response = $this->actingAs($this->userAuth, 'api')->putJson(route('api.products.update', $this->product), $data, [
            'api_token' => $this->userAuth->api_token, ])
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotDeleteAnApiProduct()
    {
        //Act & Assert
        $response = $this->actingAs($this->user)->deleteJson(route('api.products.destroy',
            $this->product))->assertStatus(401);
    }

    /** @test */
    public function anAuthorizedUserCanDeleteAnApiProduct()
    {
        //Act & Assert
        $response = $this->actingAs($this->userAuth)->deleteJson(route('api.products.destroy', $this->product), [
            'api_token' => $this->userAuth->api_token, ])
            ->assertStatus(200);
    }
}
