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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Product::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->words(rand(1,3), true),
        'price' => rand(100, 1000),
        'deadline' => rand(1, 12),
        'profitability' => rand(1,100),
        'commission' => rand(1,5),
        'active' => 1,
    ];
});
