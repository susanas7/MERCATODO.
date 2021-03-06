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

    /** @test */
    public function usersCanBeListed()
    {
        $user = factory(User::class)->create();
        $response = $this->get(route('admin.users.index'))
            ->assertOk()
            ->assertViewis('admin.users.index')
            ->assertSee($user->name);
    }
}
