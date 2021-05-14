<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Mineral; # Make our Mineral Model accessible
use App\Models\Country;

use Carbon\Carbon; # We’ll use this library to generate timestamps
use Faker\Factory; # We’ll use this library to generate random/fake data

class MineralsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Three different examples of how to add minerals
        //$this->addOnemineral();
        $this->addAllMineralsFromMineralsDotJsonFile();
    }
    /**
         *
         */
    private function addAllMineralsFromMineralsDotJsonFile()
    {
        $mineralData = file_get_contents(database_path('typemin.json'));
        $minerals = json_decode($mineralData, true);
    
        $count = count($minerals);
        foreach ($minerals as $slug => $mineralData) {
            $mineral = new mineral();

            # For the timestamps, we're using a class called Carbon that comes with Laravel
            # and provides many date/time methods.
            # Learn more: https://github.com/briannesbitt/Carbon
            $mineral->created_at = Carbon::now();
            $mineral->updated_at = Carbon::now();
            $mineral->slug = $slug;
            $mineral->IMA_reference = $mineralData['IMA_reference'];
            $mineral->author = "";//$mineralData['author'];
            $mineral->published_year = $mineralData['published_year'];
            $mineral->publication = $mineralData['publication'];
            $mineral->formula = $mineralData['formula'];
            $mineral->publication_url = "";
            $mineral->locality = $mineralData['locality'];
            //$mineral->country = $mineralData['country'];
            $mineral->country_id = Country::where('country', '=', $mineralData['country'])->pluck('id')->first();


            $mineral->save();
            $count--;
        }
    }
}