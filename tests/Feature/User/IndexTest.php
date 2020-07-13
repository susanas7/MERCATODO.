<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * @test
     */
    public function Example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
