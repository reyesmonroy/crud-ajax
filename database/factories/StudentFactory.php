<?php

use Faker\Generator as Faker;

$factory->define(App\Student::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'fecha_nacimiento' => $faker->dateTime(),
        'email' => $faker->unique()->safeEmail,
    ];
});
