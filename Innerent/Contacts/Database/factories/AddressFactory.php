<?php

use Faker\Generator as Faker;

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(\Innerent\Contacts\Models\Address::class, function (Faker $faker) {
    return [
        'street'        => $faker->streetName,
        'number'        => $faker->randomNumber() % 2 == 0 ? $faker->numberBetween(1, 9999) : null,
        'neighborhood'  => $faker->randomNumber() % 2 == 0 ? $faker->name() : null,
        'complement'    => $faker->randomNumber() % 2 == 0 ? $faker->sentence(2) : null,
        'zip'           => $faker->randomNumber() % 2 == 0 ? $faker->randomNumber(8) : null,
        'city'          => $faker->randomNumber() % 2 == 0 ? $faker->city : null,
        'county'        => $faker->randomNumber() % 2 == 0 ? $faker->domainWord : null,
        'state'         => $faker->randomNumber() % 2 == 0 ? strtoupper($faker->randomLetter.$faker->randomLetter) : null,
        'country'       => $faker->randomNumber() % 2 == 0 ? $faker->country : null,
        'description'   => $faker->randomNumber() % 2 == 0 ? $faker->sentence(3) : null,
    ];
});
