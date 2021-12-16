<?php

use App\User;
use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        // define blueprint for project model
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'owner_id' => function(){
            return factory(User::class)->create()->id;
        }
    ];
});
