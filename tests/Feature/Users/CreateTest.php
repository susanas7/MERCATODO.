<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

/**
 * @internal
 * @coversNothing
 */
class CreateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function aUserCanViewTheCreateForm()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.create'));

        $response->assertOk();
        $response->assertViewIs('users.create');
    }

    /**
     * @test
     */
    public function aUserCanStoreAnUser()
    {
        $this->withoutExceptionHandling();
        $response = $this->post(route('users.store'), [
                'name' => 'Jhon',
                'email' => 'jhon@mail.com',
                'password' => 'admin123456',
            ]);

        $user = User::first();
        $this->assertCount(1, User::all());

        $this->assertEquals('Jhon', $user->name);
        $this->assertEquals('jhon@mail.com', $user->email);
        $this->assertTrue(Hash::check('admin123456', $user->password));
        $response->assertRedirect(route('users.index'));
    }
}
