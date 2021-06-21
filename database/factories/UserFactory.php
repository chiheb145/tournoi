<?php

use Illuminate\Support\Facades\DB;
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
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
    ];
});


    DB::table('tournois')->insert([

        ['name' => 'champions league',
            'date_debut' => '2021-08-01',
            'date_fin' => '2021-08-10'
        ],
        ['name' => 'champions europe',
            'date_debut' => '2021-08-10',
            'date_fin' => '2021-08-15'
        ],
        ['name' => 'champions afrique',
            'date_debut' => '2021-08-15',
            'date_fin' => '2021-08-30'
        ]

    ]);


