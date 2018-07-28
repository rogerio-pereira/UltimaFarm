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
$factory->define(App\Models\Sale::class, function (Faker\Generator $faker) {
    static $password;

    //Datas
    $date = $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null);
    $deadline = new Carbon\Carbon($date->format('Y-m-d H:i:s'));
    $deadline->addMonths(6);

    return [
        'client_id' => rand(1,50),
        'product_id' => rand(1,8),
        'value' => 1000,
        'profitability' => 10,
        'deadline' => $deadline,
        'refundValue' => 1600,
        'created_at' => $date,
    ];
});
