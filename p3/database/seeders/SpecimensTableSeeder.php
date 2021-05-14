<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Specimen; # Make our specimen Model accessible
use Carbon\Carbon; # We’ll use this library to generate timestamps
use Faker\Factory; # We’ll use this library to generate random/fake data
use App\Models\Country;
use App\Models\Repository;
use App\Models\Mineral;

class SpecimensTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Three different examples of how to add specimens
        //$this->addOneSpecimen();
        $this->addAllSpecimensFromSpecimensDotJsonFile();
    }
    /**
         *
         */
    private function addAllSpecimensFromSpecimensDotJsonFile()
    {
        $specimenData = file_get_contents(database_path('specimen.json'));
        $specimens = json_decode($specimenData, true);
    
        $count = count($specimens);
        foreach ($specimens as $slug => $specimenData) {
            $specimen = new specimen();

            # For the timestamps, we're using a class called Carbon that comes with Laravel
            # and provides many date/time methods.
            # Learn more: https://github.com/briannesbitt/Carbon
            $specimen->created_at = Carbon::now();
            $specimen->updated_at = Carbon::now();
            $specimen->slug = $slug;
            $specimen->mineral_id = Mineral::where('slug', '=', $slug)->pluck('id')->first();

            //$specimen->IMA_reference = Country::where('country', '=', $specimenData['country'])->pluck('id')->first();

            $specimen->IMA_reference = $specimenData['IMA_reference'];
            //$specimen->author = "";//$specimenData['author'];
            $specimen->repository_id = Repository::where('display_name', '=', $specimenData['display_name'])->pluck('id')->first();
            $specimen->catalogue_entry = $specimenData['catalogue_entry'];
            $specimen->type_status = $specimenData['type_status'];
            // $specimen->country = $specimenData['country'];
            $specimen->country_id = Country::where('country', '=', $specimenData['country'])->pluck('id')->first();
            $specimen->comments = $specimenData['comments'];

            $specimen->CT = $specimenData['CT'];
            $specimen->T = $specimenData['T'];
            $specimen->HT = $specimenData['HT'];
            $specimen->NT = $specimenData['NT'];
            $specimen->PT = $specimenData['PT'];
            $specimen->AT = $specimenData['AT'];



            $specimen->save();
            $count--;
        }
    }
}