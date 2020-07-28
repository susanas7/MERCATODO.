<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class DeleteTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aUserCanBeDeleted()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $this->delete('users/{$user->id}');

    
       $this->assertDatabaseMissing('users', [
           'id' => $user->id,
           'name' => $user->name,
           'email' => $user->email,
           'email_verified_at' => $user->email_verified_at,
           'password' => $user->password,
           'role' => $user->role,
           'is_active' => $user->is_active,
           'remember_token' => $user->remember_token,
           'created_at' => $user->created_at,
           'updated_at' => $user->updated_at,
       ]);
    }
}
