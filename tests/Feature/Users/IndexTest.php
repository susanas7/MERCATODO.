<?php

namespace Tests\Feature\Users;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    
    /** @test */
    public function aUserCanListUsers()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('users.index'));

        $response->assertOk();
        //$response->assertViewIs('users.index');

        $responseUsers = $response->getOriginalContent()['users'];

        $responseUsers->each(function ($item) use ($user) {
            $this->assertEquals($user->id, $item->id);
        });
    }
}
