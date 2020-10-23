<?php

namespace Tests\Feature\Categories;

use App\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function anUnathorizedUserCanNotViewTheCreateForm()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('categories.create'));
        
        $response->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanViewTheCreateForm()
    {
        $this->artisan('db:seed');
        $user = factory(User::class)->create()->assignRole('Super-administrador');

        $response = $this->actingAs($user)->get(route('categories.create'));
        
        $response->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotViewTheUpdateForm()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('categories.create'));
        
        $response->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanViewTheUpdateForm()
    {
        $this->artisan('db:seed');
        $user = factory(User::class)->create()->assignRole('Super-administrador');
        $category = factory(ProductCategory::class)->create();

        $response = $this->actingAs($user)->get(route('categories.edit', $category));
        
        $response->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotListCategories()
    {
        $user = factory(User::class)->create();
        
        $response = $this->actingAs($user)->get(route('categories.index'));
        
        $response->assertStatus(403);
    }

    /** @test */
    public function anAthorizedUserCanListCategories()
    {
        $this->artisan('db:seed');
        $user = factory(User::class)->create()->assignRole('Super-administrador');
        $categories = factory(ProductCategory::class, 10)->create();

        $response = $this->actingAs($user)->get(route('categories.index'));
        
        $response->assertStatus(200);
    }
}
