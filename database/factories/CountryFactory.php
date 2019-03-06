<?php

use Faker\Generator as Faker;

$factory->define(App\Country::class, function (Faker $faker) {
    return [
        'name' => $faker->text(10),
        'continent' => $faker->text(12)
    ];
});
