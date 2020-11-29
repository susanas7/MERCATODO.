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

    /** @test */
    public function aCategoryCanBeStored()
    {
        $response = $this->post(route('admin.categories.store'), [
            'title' => 'Dulces',
        ])->assertSessionHasNoErrors();

        $category = ProductCategory::first();
        $this->assertCount(1, ProductCategory::all());
        $this->assertEquals('Dulces', $category->title);
        $response->assertRedirect(route('admin.categories.index'));
    }

    /** @test */
    public function aCategoryCanNotBeStoredWithEmptyTitle()
    {
        $response = $this->post(route('admin.categories.store'), [
            'title' => '',
        ])->assertSessionHasErrors('title');

        $this->assertCount(0, ProductCategory::all());
    }
}
