<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function aUserCanBeCreated()
    {
        
        $response = $this->json('POST', '/users', [
            'name' => 'Pupy',
            'email' => 'pupy@mail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);

        $response->assertJsonStructure();

        /* pasa con advertencia
        $user = factory(User::class)->create([
            'name' =>'Elisa',
            'email' => 'elisa@mail.com',
            'password' => '12345678'
        ]);

        $this->actingAs($user);*/
        
    }
}
