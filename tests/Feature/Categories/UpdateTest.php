<?php

namespace Tests\Feature\Categories;

use App\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function aCategoryCanBeUpdated()
    {
        $category = factory(ProductCategory::class)->create();

        $response = $this->put(route('categories.update', $category), [
            'title' => 'Agua',
        ]);
        $category = ProductCategory::first();

        $this->assertEquals('Agua', $category->title);
        $response->assertRedirect(route('categories.index'));
    }

    /**
     * @test
     */
    public function aCategoryCanNotBeUpdatedWithEmptyTitle()
    {
        $response = $this->post(route('categories.store'), [
            'title' => 'Agua',
        ]);

        $category = ProductCategory::first();

        $response2 = $this->put(route('categories.update', $category), [
            'title' => '',
        ]);

        $this->assertCount(1, ProductCategory::all());

        $this->assertEquals('Agua', $category->title);
        $response->assertRedirect(route('categories.index'));
    }
}
