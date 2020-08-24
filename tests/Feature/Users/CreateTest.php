<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;

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
        $response = $this->post(route('users.store'), [
                'name' => 'Juli',
                'email' => 'juli@mail.com',
                'password' => '12345678',
            ]);

        $user = User::first();
        $this->assertCount(1, User::all());

        $this->assertEquals('Juli', $user->name);
        $this->assertEquals('juli@mail.com', $user->email);
        $this->assertTrue(Hash::check('12345678', $user->password));
        $response->assertRedirect(route('users.index'));
    }

    /**
     * @test
     */
    public function aUserCanNotBeStoredWithInvalidEmail()
    {
        $user = $this->post(route('users.store'), [
                'name' => 'Juli',
                'email' => 'juli',
                'password' => '12345678',
            ]);

        $this->assertCount(0, User::all());

    }

    /**
     * @test
     */
    public function aUserCanNotBeStoredWithInvalidPassword()
    {
        $user = $this->post(route('users.store'), [
                'name' => 'Juli',
                'email' => 'juli',
                'password' => '123',
            ]);

        $this->assertCount(0, User::all());

    }
    /**
     * @test
     */
    public function aUserCanNotBeStoredWithEmptyName()
    {
        $user = $this->post(route('users.store'), [
                'name' => '',
                'email' => 'juli',
                'password' => '12345678',
            ]);

        $this->assertCount(0, User::all());

    }
    /**
     * @test
     */
    public function aUserCanNotBeStoredWithEmptyEmail()
    {
        $user = $this->post(route('users.store'), [
                'name' => 'juli',
                'email' => '',
                'password' => '12345678',
            ]);

        $this->assertCount(0, User::all());

    }
    /**
     * @test
     */
    public function aUserCanNotBeStoredWithEmptyPassword()
    {
        $user = $this->post(route('users.store'), [
                'name' => 'juli',
                'email' => 'juli@mail.com',
                'password' => '',
            ]);

        $this->assertCount(0, User::all());

    }
}
