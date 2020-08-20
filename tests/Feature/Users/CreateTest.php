<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class CreateTest extends TestCase
{
    //use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * @test
     */
    public function aUserCanViewTheCreateForm()
    {
        $this->withoutExceptionHandling();

        /*$response = $this->get(route('users.create'),[
            'name' => 'Juliana',
            'email' => 'juli@mail.com',
            'password' => '12345678'
        ]);*/
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get(route('users.create'));

        $response->assertOk();
        //$this->assertCount(1, User::all());
        $response->assertViewIs('users.create');
        /*$this->assertDatabaseHas('users', [
            'name' => 'Juliana',
            'email' => 'juli@mail.com',
            'email_verified_at' => $response->email_verified_at,
            'password' => '12345678'
        ]);*/
    }

    /**
     * @test
     */
    public function aUserCanStoreAUser()
    {
        $response = $this->post(route('users.store'), [
                'name' => 'Jhon',
                'email' => 'jhon@mail.com',
                'password' => 'admin123456',
            ]);

        //Assert
        //$userA = User::orderBy('id', 'desc')->first();

        /*$this->assertEquals('Jhon', $userA->first_name);
        $this->assertEquals('Doe', $userA->last_name);
        $this->assertEquals('jhon@mail.com', $userA->email);
        $this->assertTrue(Hash::check('admin123456', $userA->password));
        $this->assertTrue(Cache::has('user.' . $userA->id));
        $response->assertRedirect(route('users.index'));*/
        $this->assertDatabaseHas('users', [
            'name' => 'Jhon',
            'email' => 'jhon@mail.com',
            'password' => 'admin123456',
        ]);

        $response->delete();

    }
}
