<?php

namespace Tests\Feature\Categories;

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
        $response = $this->get(route('categories.index'))
            ->assertOk()
            ->assertViewHas('categories');
        $responseCategories = $response->getOriginalContent()['categories'];
    }
}
