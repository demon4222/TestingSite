<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Test;
use Faker\Generator as Faker;

$factory->define(Test::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence
    ];
});
