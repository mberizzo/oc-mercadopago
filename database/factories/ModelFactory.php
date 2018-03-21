<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(Rainlab\User\Models\User::class, function ($faker) {
    return [
        'name' => $faker->firstName(),
        'surname' => $faker->lastName(),
        'email' => $faker->email(),
        'created_at' => date('Y-m-d h:m:s'),
    ];
});
