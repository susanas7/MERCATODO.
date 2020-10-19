<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserData;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(UserData::class, function (Faker $faker) {
    return [
        'user_id' => '1',
        'document_type' => 'CC',
        'document' => '1001333999',
        'address' => 'Calle falsa',
        'phone' => '42345982',
        'birthday' => $faker->date('Y-m-d'),
    ];
});
