<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class ShowTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aUserCanSeeDetailsOfUsers()
    {
        $this->withoutExceptionHandling();
        //$this->expectException(\Illuminate\Auth\AuthenticationException::class);

        $user = factory(User::class)->create();
        $response = $this->get(route('users.show' , $user));
        $response->assertStatus(200);
        $response->assertViewIs('users.show');


    }
}
