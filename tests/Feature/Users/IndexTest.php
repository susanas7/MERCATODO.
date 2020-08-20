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
final class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testAUserCanListUsers()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get(route('users.index'))
        ;

        $response->assertOk();
        //$response->assertViewIs('users.index');

        $responseUsers = $response->getOriginalContent()['users'];

        $responseUsers->each(function ($item) use ($user) {
            $this->assertSame($user->id, $item->id);
        });
    }
}
