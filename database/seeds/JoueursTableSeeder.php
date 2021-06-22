<?php

use Illuminate\Database\Seeder;

class JoueursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Joueurs::class,5)->create()->each(function ($p) {
            $p->save();
        });
    }
}
