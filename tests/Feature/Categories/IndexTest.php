<?php

namespace Tests\Feature\Categories;

use App\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function anUserCanListCategories()
    {
        $category = factory(ProductCategory::class)->make();

        $response = $this->get(route('categories.index'));
        $categories = ProductCategory::all();

        $response->assertOk();
        $responseCategories = $response->getOriginalContent()['categories'];
        $responseCategories->each(function ($item) use ($category) {
            $this->assertSame($category->id, $item->id);
        });
    }
}
