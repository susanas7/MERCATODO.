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

        $response = $this->put(route('categories.update', $category), [
            'title' => 'Agua',
        ]);
        $category->refresh();

        $this->assertEquals('Agua', $category->title);
        $response->assertRedirect(route('categories.index'));
    }

    /** @test */
    public function aCategoryCanNotBeUpdatedWithEmptyTitle()
    {
        $category = factory(ProductCategory::class)->create();

        $response = $this->put(route('categories.update', $category), [
            'title' => '',
        ])->assertSessionHasErrors('title');
    }
}
