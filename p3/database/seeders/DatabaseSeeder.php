<?php

namespace Database\Seeders;

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
        $this->call(UsersTableSeeder::class);

        $this->call(CountriesTableSeeder::class);

        $this->call(MineralsTableSeeder::class);
    
        $this->call(FormulasTableSeeder::class);
        $this->call(RepositoriesTableSeeder::class);
 
        $this->call(SpecimensTableSeeder::class);
    }
}