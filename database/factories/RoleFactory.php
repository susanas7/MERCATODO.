<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <fabien@symfony.com>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Faker\Generator as Faker;
use Spatie\Permission\Models\Role;

$factory->define(Role::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'guard_name' => 'web',
        'slug' => $faker->slug(2),
    ];
});
