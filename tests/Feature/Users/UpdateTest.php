<?php

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;

class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    use WithFaker;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function anUserCanBeUpdated()
    {
        $response = $this->put(route('users.update', $this->user), [
            'name' => 'Elisa',
            'email' => 'elisa@mail.com',
        ]);
        $user = User::first();

        $this->assertEquals('Elisa', $user->name);
        $this->assertEquals('elisa@mail.com', $user->email);
    }

    /**
     * @test
     * @dataProvider dataProvider
     * @param string $field
     * @param mixed|null $value
     */
    public function anUserCanNotBeUpdatedWithInvalidData(string $field, $value = null)
    {
        $data = [
            'name' => $this->faker->sentence(1),
            'email' => $this->faker->unique()->safeEmail,
        ];
        $data[$field] = $value;

        $response = $this->put(route('users.update', $this->user), $data)
            ->assertRedirect()
            ->assertSessionHasErrors($field);
    }

    public function dataProvider(): array
    {
        return [
            'Test name is required' => ['name', null],
            'Test email is required' => ['email', null],
            'Test email is not an email' => ['email', Str::random(12)],
        ];
    }
}
