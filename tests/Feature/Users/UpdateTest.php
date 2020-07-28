<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /** @test */
    public function aUserCanBeUpdated()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->put(route('users.show' , $user), [
            'name' =>'Elisa',
            'email' => 'elisa@mail.com',
        ]);

        $this->assertDatabaseHas('users', [
            'name' =>'Elisa',
            'email' => 'elisa@mail.com',
        ]);
        

    }
}
