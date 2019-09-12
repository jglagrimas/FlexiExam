<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Player;
use Faker\Generator as Faker;

$factory->define(Player::class, function (Faker $faker) {
    return [
		'chance_of_playing_next_round' => $faker->boolean,
		'chance_of_playing_this_round' => $faker->boolean,
		'first_name' => $faker->firstName,
		'second_name' => $faker->lastName,
		'points_per_game' => $faker->randomFloat(NULL, $min = 0, $max = 10),
		'goals_scored' => $faker->randomDigitNotNull,
		'assists' => $faker->randomDigitNotNull,
		'clean_sheets' => $faker->randomDigitNotNull,
		'goals_conceded' => $faker->randomDigitNotNull,
		'influence' => $faker->randomFloat(NULL,0,10),
		'creativity' => $faker->randomFloat(NULL,0,10),
		'threat' => $faker->randomFloat(NULL,0,10),
		'ict_index' => $faker->randomFloat(NULL,0, 10),
		'player_id' => $faker->randomNumber,
		'web_name' => $faker->name,
    ];
});
