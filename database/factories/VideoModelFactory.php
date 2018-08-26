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
$factory->define(App\Models\Video::class, function (Faker\Generator $faker) {

    
    $faker->addProvider(new Faker\Provider\Youtube($faker));

    return [
        'title' => $faker->sentence(5, true),
        'description' => $faker->paragraph(2, true),
        'url' => $faker->youtubeUri(),
        'image' => $faker->imageUrl(600, 400, 'abstract', true, 'Imagem Ilustrativa', false),
        'active' => true
    ];
});
