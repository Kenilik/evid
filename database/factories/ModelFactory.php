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

// Create 

$factory->define(App\Investigation::class, function (faker\Generator $faker) 
{
	return [
		'case_num' => $faker->numberBetween($min = 10000, $max = 99999) . '/' . $faker->numberBetween($min = 1000, $max = 9999),
		'operation_name' => $faker->lastName,
		'description' => $faker->sentence($nb = 6, $variableNbWords = true),
        'is_active' => $faker->boolean($chanceOfGettingTrue = 80)
	];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'name' => $faker->name,
        'qid' => $faker->randomLetter . $faker->randomLetter . $faker->randomLetter . $faker->randomLetter . $faker->randomDigit . $faker->randomDigit,
        'email' => $faker->unique->safeEmail,
        'password' => $password ?: $password = bcrypt('precious')
    ];
});

$factory->define(App\InvUser::class, function (Faker\Generator $faker) {
    $users = App\User::pluck('id')->toArray();
    $invs = App\Investigation::pluck('id')->toArray();
    return [
        'user_id' => $faker->randomElement($users),
        'investigation_id' => $faker->randomElement($invs)
    ];
});