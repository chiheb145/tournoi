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



DB::table('tournois')->insert(array(
    0 =>
        array(
            'name' => 'champions league',
            'date_debut' => '2021-08-01',
            'date_fin' => '2021-08-15'
        ),
    1 =>
        array(
            'name' => 'coupe afrique',
            'date_debut' => '2021-08-15',
            'date_fin' => '2021-08-30'
        ),
    2 =>
        array(
            'name' => 'coupe europe',
            'date_debut' => '2021-09-01',
            'date_fin' => '2021-09-15'
        )
));
DB::table('equipes')->insert(array(
    0 =>
        array(
            'name' => 'equipe A',
            'antraineur_id' => 1

        ),
    1 =>
        array(
            'name' => 'equipe B',
            'antraineur_id' => 2

        ),
    2 =>
        array(
            'name' => 'equipe C',
            'antraineur_id' => 3
        ),
    3 =>
        array(
            'name' => 'equipe D',
            'antraineur_id' =>4
        ),
    4 =>
        array(
            'name' => 'equipe E',
            'antraineur_id' => 5
        )
));
DB::table('matches')->insert(array(
    0 =>
        array(
            'tournoi_id' => 1,
            'equipe_one' => 1,
            'equipe_two' => 2,
            'date' => "2021-08-01"
        ),
    1 =>
        array(
            'tournoi_id' => 1,
            'equipe_one' => 2,
            'equipe_two' => 3,
            'date' => "2021-08-03"

        ),
    2 =>
        array(
            'tournoi_id' => 2,
            'equipe_one' => 2,
            'equipe_two' => 3,
            'date' => "2021-08-16"
        ),
    3 =>
        array(
            'tournoi_id' => 2,
            'equipe_one' => 4,
            'equipe_two' => 3,
            'date' => "2021-08-19"
        ),
    4 =>
        array(
            'tournoi_id' => 3,
            'equipe_one' => 4,
            'equipe_two' => 5,
            'date' => "2021-09-02"
        )
));
DB::table('equipes_joueurs')->insert(array(
    0 =>
        array(
            'equipe_id' => 1,
            'joueur_id' => 1,
            'is_active' => 1
        ),
    1 =>
        array(
            'equipe_id' => 2,
            'joueur_id' => 2,
            'is_active' => 1

        ),
    2 =>
        array(
            'equipe_id' => 3,
            'joueur_id' => 3,
            'is_active' => 1
        )

));
DB::table('joueurs')->insert(array(
    0 =>
        array(
            'first_name' => 'Philipe ',
            'last_name' => 'mauris',
            'is_affected' => 1

        ),
    1 =>
        array(
            'first_name' => 'Alain ',
            'last_name' => 'rono',
            'is_affected' => 1

        ),
    2 =>
        array(
            'first_name' => 'Mike ',
            'last_name' => 'teo',
            'is_affected' => 1
        ),
    3 =>
        array(
            'first_name' => 'valenti ',
            'last_name' => 'kido',
            'is_affected' => 0
        ),
    4 =>
        array(
            'first_name' => 'Alex',
            'last_name' => 'cristian',
            'is_affected' => 0
        )
));
DB::table('entraineurs')->insert(array(
    0 =>
        array(
            'first_name' => 'adriano ',
            'last_name' => 'alfonso',
            'is_affected' => 1

        ),
    1 =>
        array(
            'first_name' => 'Jean ',
            'last_name' => 'jack',
            'is_affected' => 1

        ),
    2 =>
        array(
            'first_name' => 'Maurinho ',
            'last_name' => 'Momo',
            'is_affected' => 1
        ),
    3 =>
        array(
            'first_name' => 'Ali ',
            'last_name' => 'sassi',
            'is_affected' => 1
        ),
    4 =>
        array(
            'first_name' => 'fawzi ',
            'last_name' => 'mounir',
            'is_affected' => 1
        )
));
DB::table('users')->insert([
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'password' => bcrypt('123456')
]
);


