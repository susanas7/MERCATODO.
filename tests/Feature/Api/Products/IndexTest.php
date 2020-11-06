<?php

namespace Tests\Feature\Api\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testola()
    {
        $this->withoutExceptionHandling();
        $response = $this->getJson(route('api.products.index'));

        $response->assertStatus(200)->assertJsonStructure(['products']);
    }
}
