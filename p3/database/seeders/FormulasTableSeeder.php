<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Formula; # Make our formula Model accessible
use Carbon\Carbon; # We’ll use this library to generate timestamps
use Faker\Factory; # We’ll use this library to generate random/fake data

class FormulasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addAllFormulasFromFormulasDotJsonFile();

        //
    }

    private function addAllFormulasFromFormulasDotJsonFile()
    {
        $formulaData = file_get_contents(database_path('minlist.json'));
        $formulas = json_decode($formulaData, true);
    
        $count = count($formulas);
        foreach ($formulas as $slug => $formulaData) {
            $formula = new formula();

            # For the timestamps, we're using a class called Carbon that comes with Laravel
            # and provides many date/time methods.
            # Learn more: https://github.com/briannesbitt/Carbon
            

            $formula->created_at = Carbon::now();
            $formula->updated_at = Carbon::now();
            $formula->species = $formulaData['species'];

            $formula->formula = $formulaData['formula'];
            $formula->locality = $formulaData['locality'];
            $formula->country = $formulaData['country'];

            $formula->meteorite = $formulaData['meteorite'];
            $formula->valid = $formulaData['valid'];


            $formula->save();
            $count--;
        }
    }
}