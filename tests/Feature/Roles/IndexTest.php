<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Tests\Feature\Roles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/**
 * @internal
 * @coversNothing
 */
final class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function testAUserCanListRoles()
    {
        $this->withoutExceptionHandling();

        $role = factory(Role::class)->create();

        $response = $this->get(route('roles.index'));
        $response->assertOk();
        $responseRoles = $response->getOriginalContent()['roles'];
        $responseRoles->each(function ($item) use ($role) {
            $this->assertSame($role->id, $item->id);
        });
    }
}
