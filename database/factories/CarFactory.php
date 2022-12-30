<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Car;
use Faker\Generator as Faker;

$factory->define(Car::class, function (Faker $faker) {
    return [
        'manufacturer' => $faker->realText(30),
        'name' => $faker->realText(30),
        'description' => $faker->realText(),
    ];
});
