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
$factory->define(App\Models\Client::class, function (Faker\Generator $faker) {
    
    $faker = Faker\Factory::create('pt_br');
    $faker->addProvider(new Faker\Provider\pt_BR\Address($faker));
    $faker->addProvider(new Faker\Provider\pt_BR\Person($faker));
    $faker->addProvider(new Faker\Provider\pt_BR\PhoneNumber($faker));

    return [
        /*'name' => $faker->firstName.' '.$faker->lastName,
        'email' => $faker->safeEmail,*/
        'telephone' => $faker->phoneNumber,
        'document' => $faker->cpf,
        'street' => $faker->streetName,
        'number' => rand(1,100),
        'complement' => $faker->secondaryAddress,
        'zipcode' => $faker->postcode,
        'neighborhood' => $faker->sentence(2, true),
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now', $timezone = null)
    ];
});
