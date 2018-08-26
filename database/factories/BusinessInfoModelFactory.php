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
$factory->define(App\Models\BusinessInfo::class, function (Faker\Generator $faker) {

    $faker = Faker\Factory::create('pt_br');
    $faker->addProvider(new Faker\Provider\pt_BR\Company($faker));

    return [
        'companyName' => $faker->company,
        'cnpj' => $faker->cnpj,
    ];
});
