<?php

namespace Tests\Feature\Categories;

use App\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function categoriesCanBeListed()
    {
        $category = factory(ProductCategory::class)->create();

        $response = $this->get(route('admin.categories.index'))
            ->assertOk()
            ->assertViewis('admin.categories.index')
            ->assertSee($category->name);
    }
}
