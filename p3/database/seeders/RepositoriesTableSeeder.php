<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Repository; # Make our repository Model accessible
use Carbon\Carbon; # We’ll use this library to generate timestamps
use Faker\Factory; # We’ll use this library to generate random/fake data
use App\Models\Country;

class RepositoriesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Three different examples of how to add repositorys
        //$this->addOneRepository();
        $this->addAllRepositoriesFromrepositoriesDotJsonFile();
    }
    /**
         *
         */
    private function addAllRepositoriesFromrepositoriesDotJsonFile()
    {
        $repositoryData = file_get_contents(database_path('respository.json'));
        $repositories = json_decode($repositoryData, true);
    
        $count = count($repositories);
        foreach ($repositories as $slug => $repositoryData) {
            $repository = new repository();

            # For the timestamps, we're using a class called Carbon that comes with Laravel
            # and provides many date/time methods.
            # Learn more: https://github.com/briannesbitt/Carbon
            $repository->created_at = Carbon::now();
            $repository->updated_at = Carbon::now();
            $repository->slug = $slug;
            $repository->display_name = $repositoryData['display_name'];
         
            // $repository->country = $repositoryData['country'];
            $repository->country_id = Country::where('country', '=', $repositoryData['country'])->pluck('id')->first();
            $repository->comments = $repositoryData['comments'];


            $repository->save();
            $count--;
        }
    }
}