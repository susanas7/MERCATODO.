<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function aUserCanListUsers()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.index'));
        $users = User::all();

        $response->assertOk();
        $responseUsers = $response->getOriginalContent()['users'];
        $responseUsers->each(function ($item) use ($user) {
            $this->assertSame($user->id, $item->id);
        });
    }
}
