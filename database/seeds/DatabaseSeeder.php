<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TournoisTableSeeder::class);
        $this->call(EquipesTableSeeder::class);
        $this->call(MatchesTableSeeder::class);
        $this->call(Equipes_joueursTableSeeder::class);
        $this->call(JoueursTableSeeder::class);
        $this->call(EntraineursTableSeeder::class);
        $this->call(UserTableSeeder::class);

    }
}
