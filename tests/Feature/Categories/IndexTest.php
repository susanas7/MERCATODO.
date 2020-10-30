<?php

namespace Tests\Feature\Categories;

use App\ProductCategory;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function anUserCanListCategories()
    {
        $user = factory(User::class)->create();
        $category = factory(ProductCategory::class)->create();

        $response = $this->get(route('categories.index'));

        $response->assertOk();
        $response->assertViewHas('categories');
        $responseCategories = $response->getOriginalContent()['categories'];
    }
}
