<?php

use Faker\Generator as Faker;

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Innerent\Contacts\Models\Phone::class, function (Faker $faker) {
    return [
        'number'        => $faker->phoneNumber,
        'country_code'  => $faker->randomNumber() % 2 == 0 ? $faker->numberBetween(1, 99) : null,
        'area_code'     => $faker->randomNumber() % 2 == 0 ? $faker->numberBetween(1, 99) : null,
        'type'          => $faker->randomNumber() % 2 == 0 ? $faker->word : null,
        'description'   => $faker->randomNumber() % 2 == 0 ? $faker->sentence(4) : null,
    ];
});
