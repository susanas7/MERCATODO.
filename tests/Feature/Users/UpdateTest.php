<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function aUserCanBeUpdated()
    {
        //$this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this->put(route('users.update', $user), [
            'name' => 'Elisa',
            'email' => 'elisa@mail.com',
        ]);
        $user = User::first();

        $this->assertEquals('Elisa', $user->name);
        $this->assertEquals('elisa@mail.com', $user->email);
    }

    /**
     * @test
     */
    public function aUserCanNotBeUpdatedWithInvalidEmail()
    {
        $response = $this->post(route('users.store'), [
            'name' => 'Juli',
            'email' => 'juli@mail.com',
            'password' => '12345678',
        ]);

        $user = User::first();

        $response2 = $this->put(route('users.update', $user), [
            'name' => 'Elisa',
            'email' => 'elisa',
        ]);

        $this->assertCount(1, User::all());
        $this->assertEquals('Juli', $user->name);
        $this->assertEquals('juli@mail.com', $user->email);
        $this->assertTrue(Hash::check('12345678', $user->password));
        $response->assertRedirect(route('users.index'));
    }

    /**
     * @test
     */
    public function aUserCanNotBeUpdatedWithEmptyName()
    {
        $response = $this->post(route('users.store'), [
            'name' => 'Juli',
            'email' => 'juli@mail.com',
            'password' => '12345678',
        ]);

        $user = User::first();

        $response2 = $this->put(route('users.update', $user), [
            'name' => '',
            'email' => 'elisa@mail.com',
        ]);

        $this->assertCount(1, User::all());
        $this->assertEquals('Juli', $user->name);
        $this->assertEquals('juli@mail.com', $user->email);
        $this->assertTrue(Hash::check('12345678', $user->password));
        $response->assertRedirect(route('users.index'));
    }

    /**
     * @test
     */
    public function aUserCanNotBeUpdatedWithEmptyEmail()
    {
        $response = $this->post(route('users.store'), [
            'name' => 'Juli',
            'email' => 'juli@mail.com',
            'password' => '12345678',
        ]);

        $user = User::first();

        $response2 = $this->put(route('users.update', $user), [
            'name' => 'Elisa',
            'email' => '',
        ]);

        $this->assertCount(1, User::all());
        $this->assertEquals('Juli', $user->name);
        $this->assertEquals('juli@mail.com', $user->email);
        $this->assertTrue(Hash::check('12345678', $user->password));
        $response->assertRedirect(route('users.index'));
    }
}
