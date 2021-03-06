<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    $now = Carbon::now()->toDateTimeString();
    $array = [1,2,3,4,5,6,7,8];
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('dddddd'), // secret
        'remember_token' => str_random(10),
        'created_at' => $now,
        'updated_at' => $now,
        'occupation_id' => array_random($array),
        'city_id' => array_random($array),
    ];
});
