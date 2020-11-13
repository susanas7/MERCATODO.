<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;

class CreateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    use WithFaker;

    /** @test */
    public function anUserCanBeStored()
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
     * @dataProvider dataProvider
     * @param string $field
     * @param mixed|null $value
     */
    public function anUserCanNotBeStoredWithInvalidData(string $field, $value = null)
    {
        $data = [
            'name' => $this->faker->sentence(1),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Str::random(9),
        ];
        $data[$field] = $value;

        $response = $this->post(route('users.store'), $data)
            ->assertRedirect()
            ->assertSessionHasErrors($field);
    }

    public function dataProvider(): array
    {
        return [
            'Test name is required' => ['name', null],
            'Test email is required' => ['email', null],
            'Test email is not an email' => ['email', Str::random(12)],
            'Test password is required' => ['password', null],
            'Test password is too short' => ['password', Str::random(4)],
        ];
    }
}
