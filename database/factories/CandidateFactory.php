<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Candidate;
use Faker\Generator as Faker;

$factory->define(Candidate::class, function (Faker $faker) {
    
     return [
        'name' => $faker->name,
        'surname'=>$faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->numberBetween(3002000000,3109999999),
        'date_of_interview'=>$faker->dateTimeThisYear(),
        'qualification' => $faker->numberBetween(1,10)
	];    

});


