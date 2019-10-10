<?php

use Faker\Generator as Faker;

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Innerent\Contacts\Models\Email::class, function (Faker $faker) {
    return [
        'address'       => $faker->email,
        'description'   => $faker->randomNumber() % 2 == 0 ? $faker->sentence(3) : null,
        'type'          => $faker->randomNumber() % 2 == 0 ? $faker->word : null,
        'provider'      => $faker->randomNumber() % 2 == 0 ? $faker->word : null,
    ];
});
