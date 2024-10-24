<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});


$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slug' => $faker->md5,
    ];
});


$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,10),
        'category_id' =>  rand(1,10),
        'name' => $faker->name,
        'price' => rand(100,500),
        'image' => $faker->imageUrl,
        'description' => $faker->paragraph,
        'slug' => $faker->md5,
    ];
});

