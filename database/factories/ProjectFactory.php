<?php

use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        // define blueprint for project model
        'title' => $faker->sentence,
        'description' => $faker->paragraph
    ];
});
