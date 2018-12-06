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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'role_id' => 1,
        'is_active' => 1,
        'name' => "Keen Corsiga",
        'email' => "keencorsiga21@gmail.com",
        'password' => bcrypt(112233),
        'remember_token' => str_random(12)
    ];
});


// $factory->define(App\Post::class, function(Faker\Generator $faker){
//     return [
//         'user_id' => $faker->numberBetween(1, 5),
//         'category_id' => $faker->numberBetween(1, 4),
//         'title' => $faker->sentence,
//         'body' => $faker->text,
//         'slug' => $faker->slug()
//     ];
// });

//
//
$factory->define(App\Category::class, function(Faker\Generator $faker){
  return [
    'name' => $faker->randomElement(['PHP', 'HTML', 'Javascript', 'Bootstrap'])
  ];
});

$factory->define(App\Role::class, function(Faker\Generator $faker){
  return [
    'name'=> 'administrator'
  ];
});
