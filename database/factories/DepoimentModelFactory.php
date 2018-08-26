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
$factory->define(App\Models\Depoiment::class, function (Faker\Generator $faker) {

    $faker = Faker\Factory::create('pt_br');
    $faker->addProvider(new Faker\Provider\pt_BR\Person($faker));

    return [
        'name' => $faker->name,
        'depoiment' => $faker->sentence(5,true),
        'image' => $faker->imageUrl(500, 500, 'people', true, 'Imagem Ilustrativa', false), 
        'active' => true,
    ];
});
