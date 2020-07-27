<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /** @test */
    public function aUserCanSeeDetailsOfUsers()
    {
        $response = $this->get(route('users.index'));

        $response->assertRedirect('login');
    }
}
