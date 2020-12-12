<?php

namespace Tests\Feature\Categories;

use App\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aCategoryCanBeUpdated()
    {
        $category = factory(ProductCategory::class)->create();

        $response = $this->put(route('admin.categories.update', $category), [
            'title' => 'Agua',
        ])->assertRedirect(route('admin.categories.index'))
        ->assertSessionHasNoErrors();
        $category = ProductCategory::all()->last();

        $this->assertEquals('Agua', $category->title);
    }

    /** @test */
    public function aCategoryCanNotBeUpdatedWithEmptyTitle()
    {
        $category = factory(ProductCategory::class)->create();

        $response = $this->put(route('admin.categories.update', $category), [
            'title' => '',
        ])->assertSessionHasErrors('title');
    }
}
