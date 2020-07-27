<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithoutMiddleware;


class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function aUserCanBeCreated()
    {

        $this->withoutExceptionHandling();
        $this->expectException(\Illuminate\Auth\AuthenticationException::class);

        $this->get('/users/create', [
            'name' =>'Elisa',
            'email' => 'elisa@mail.com',
            'password' => '12345678'
        ]);

        $this->assertCredentials([
            'name' =>'Elisa',
            'email' => 'elisa@mail.com',
            'password' => '12345678'
        ]);
        
    }
}
