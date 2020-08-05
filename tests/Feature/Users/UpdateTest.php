<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tests\Feature\Users;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class UpdateTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testAUserCanBeUpdated()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $this->put(route('users.update', $user), [
            'name' => 'Elisa',
            'email' => 'elisa@mail.com',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Elisa',
            'email' => 'elisa@mail.com',
        ]);
    }
}
