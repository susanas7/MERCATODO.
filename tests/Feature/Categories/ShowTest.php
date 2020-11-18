<?php

namespace Tests\Feature\Categories;

use App\ProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ShowTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aCategoryCanBeShown()
    {
        $category = factory(ProductCategory::class)->create();

        $response = $this->get(route('categories.show', $category))
            ->assertStatus(200)
            ->assertViewIs('categories.show');
    }
}
