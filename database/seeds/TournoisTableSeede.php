<?php

use Illuminate\Database\Seeder;

class TournoisTableSeede extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Tournois::class, 3)->create()->each(function ($p) {
            $p->save();
        });
    }
}
