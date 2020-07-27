<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\DB;
//use Illuminate\Foundation\Testing\WithoutMiddleware;


class UserTest extends TestCase
{
    //use RefreshDatabase;

    /** @test */
    public function aUserCanBeCreated()
    {

        $this->withoutExceptionHandling();
        $this->expectException(\Illuminate\Auth\AuthenticationException::class);



        /*$response = $this->json('POST', '/users', [
            'name' => 'Pupy',
            'email' => 'pupy@mail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);

        $response->assertJsonStructure();*/

        /* pasa con advertencia
        $user = factory(User::class)->create([
            'name' =>'Elisa',
            'email' => 'elisa@mail.com',
            'password' => '12345678'
        ]);

        $this->actingAs($user);*/

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
