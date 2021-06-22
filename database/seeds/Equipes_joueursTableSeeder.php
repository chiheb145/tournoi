<?php

use Illuminate\Database\Seeder;

class Equipes_joueursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Equipes_joueurs::class, 3)->create()->each(function ($p) {
            $p->save();
        });
    }
}
