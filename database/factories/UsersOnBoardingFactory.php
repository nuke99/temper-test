<?php

use Faker\Generator as Faker;


$factory->define(\App\UsersOnboarding::class, function (Faker $faker) {
    return [
        'user_id' => $faker->unique()->randomNumber(),
        'created_at' => $faker->date('Y-m-d'),
        'onboarding_percentage' => $faker->randomElement([0, 20, 40, 50, 70, 90, 99, 100]),
        'count_applications' => $faker->randomNumber(),
        'count_accepted_applications' => $faker->randomNumber()
    ];
});
