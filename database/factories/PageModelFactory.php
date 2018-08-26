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
$factory->define(App\Models\Page::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->words(2, true),
        'description' => $faker->sentence(10), 
        'text' => $faker->paragraphs(3,true), 
        'image' => $faker->imageUrl(600, 400, 'abstract', true, 'Imagem Ilustrativa', false), 
        'page_category_id' => rand(1,3),
        'show_title' => true
    ];
});
