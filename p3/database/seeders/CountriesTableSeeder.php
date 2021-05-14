<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Country; # Make our country Model accessible
use Carbon\Carbon; # We’ll use this library to generate timestamps
use Faker\Factory; # We’ll use this library to generate random/fake data

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addAllCountriesFromCountriesDotJsonFile();

        //
    }

    private function addAllCountriesFromCountriesDotJsonFile()
    {
        $countryData = file_get_contents(database_path('countries.json'));
        $countries = json_decode($countryData, true);
    
        $count = count($countries);
        foreach ($countries as $slug => $countryData) {
            $country = new country();

            $country->created_at = Carbon::now();
            $country->updated_at = Carbon::now();
           
            $country->country = $countryData['country'];


            $country->save();
            $count--;
        }
    }
}