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
$factory->define(App\Models\Comission::class, function (Faker\Generator $faker) {
    static $password;

    //Datas
    $date = $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null);
    $deadline = new Carbon\Carbon($date->format('Y-m-d H:i:s'));
    $deadline->addMonths(6);

    return [
        'client_id' => rand(1,50),
        'sale_id' => rand(1,50),
        'value' => 50,
        'deadline' => $deadline,
        'created_at' => $date,
    ];
});
