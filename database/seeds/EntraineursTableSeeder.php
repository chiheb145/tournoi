<?php

use Illuminate\Database\Seeder;

class EntraineursTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Entraineurs::class, 5)->create()->each(function ($p) {
            $p->save();
        });
    }
}
