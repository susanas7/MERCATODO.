<?php

namespace Tests\Feature\Categories;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\ProductCategory;

class DeleteTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aCategoryCanBeDeleted()
    {
        $category = factory(ProductCategory::class)->create();

        $this->delete(route('categories.destroy', $category));

        $this->assertDatabaseMissing('product_categories', [
            'id' => $category->id,
            'title' => $category->title,
            'updated_at' => $category->updated_at->toDateString(),
            'created_at' => $category->created_at->toDateString(),
        ]);
    }
}
