<?php

namespace Tests\Feature\Categories;

use App\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function aUserCanViewTheCreateCategoryForm()
    {
        $response = $this->get(route('categories.create'));

        $response->assertOk();
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function aUserCanStoreACategory()
    {
        $response = $this->post(route('categories.store'), [
            'title' => 'Dulces',
        ]);

        $category = ProductCategory::first();
        $this->assertCount(1, ProductCategory::all());

        $this->assertEquals('Dulces', $category->title);
        $response->assertRedirect(route('categories.index'));
    }

    /**
     * @test
     */
    public function aCategoryCanNotBeStoredWithEmptyTitle()
    {
        $category = $this->post(route('categories.store'), [
            'title' => '',
        ]);

        $this->assertCount(0, ProductCategory::all());
    }
}
