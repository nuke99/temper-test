<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(\App\Admins::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => env('DEFAULT_ADMIN_EMAIL'),
        'password' => Hash::make(env('DEFAULT_ADMIN_PASSWORD')),
        'status' => true
    ];
});
