<?php

namespace Tests\Feature\Categories;

use App\ProductCategory;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $userAuth;
    private $category;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:refresh --seed');
        $this->artisan('optimize:clear');
        $this->user = factory(User::class)->create();
        $this->userAuth = factory(User::class)->create()->assignRole('Super-administrador');
        $this->category = factory(ProductCategory::class)->create();
    }

    /** @test */
    public function anUnathorizedUserCanNotViewTheCreateForm()
    {
        $response = $this->actingAs($this->user)->get(route('admin.categories.create'))
            ->assertStatus(403);
    }

    /** @test */
    public function anAuthorizedUserCanViewTheCreateForm()
    {
        $response = $this->actingAs($this->userAuth)->get(route('admin.categories.create'))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotViewTheUpdateForm()
    {
        $response = $this->actingAs($this->user)->get(route('admin.categories.create'))
            ->assertStatus(403);
    }

    /** @test */
    public function anAuthorizedUserCanViewTheUpdateForm()
    {
        $response = $this->actingAs($this->userAuth)->get(route('admin.categories.edit', $this->category))
            ->assertStatus(200);
    }

    /** @test */
    public function anUnathorizedUserCanNotListCategories()
    {
        $response = $this->actingAs($this->user)->get(route('admin.categories.index'))
            ->assertStatus(403);
    }

    /** @test */
    public function anAuthorizedUserCanListCategories()
    {
        $response = $this->actingAs($this->userAuth)->get(route('admin.categories.index'))
            ->assertStatus(200);
    }
}
