<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class MineralController extends Controller
{
    /**
     * GET /
     */
    public function welcome()
    {
        # Load countries for dropdown list
        $countries = json_decode(file_get_contents(database_path('countries.json')), true);

        # If we land on this page after doing a search, we'll have the following data available
        $searchResults = session('searchResults', null);
      
        return view('minerals/welcome', [
            'searchResults' => $searchResults,
            'countries' => $countries,
        ]);
    }

    /**
     * GET /search
     */
    public function search(Request $request)
    {
        # Validate
        $request->validate([
            'element' => 'exclude_if:element,null|max:2|alpha',
            'searchTerms' => 'exclude_if:searchTerms,null|alpha'
        ]);

        # Load data
        $minerals = json_decode(file_get_contents(database_path('minlist.json')), true);
        
        # Get values from form request
        $searchTerms = $request->input('searchTerms', null);
        $minRock = $request->input('minRock', null);
        $element = $request->input('element', null);
        $locality = $request->input('locality', null);

        # Array to collect results
        $searchResults = [];

        # Loop through each mineral checking if it meets our search criteria
        foreach ($minerals as $id => $mineral) {

            # $include is a flag we'll use to track whether a given mineral should be included in our search result
            # We’ll initialize it as `true` and run each of our criteria below.
            # If a criteria fails, $include gets toggled to false.
            # The next criteria will only evaluate if $include is still true (i.e. the previous criteria passed)
            # If at the end, $include is true, we know all the necessary criterias passed and that
            # mineral should be included in the search results
            $include = true;
            
            # Criteria 1: If they entered a search term, it must be included in the Species (name)
            if (!is_null($searchTerms) && !Str::contains($mineral['Species'], $searchTerms)) {
                $include = false;
            }

            # Criteria 2: If looking for a mineral, only include results that are minerals (Valid == true)
            if ($include && $minRock == 'mineral' && $mineral['Valid'] != true) {
                $include = false;
            }

            # Criteria 3: If they're looking for a rock, only include results that are rocks (Valid == false)
            if ($include && $minRock == 'rock' && $mineral['Valid'] != false) {
                $include = false;
            }

            # Criteria 4: If they're looking for a mineral with a specific element, search the Formula
            if ($include && !is_null($element) && !Str::contains($mineral['Formula'], $element)) {
                $include = false;
            }
            
            # Criteria 5: If they’re looking for a mineral from a specific country, search the TypeLocality
            if ($include && !is_null($locality) && !Str::contains($mineral['TypeLocality'], $locality)) {
                $include = false;
            }

            # If it passed all above the above criteria, include it in our search results
            if ($include) {
                $searchResults[$id] = $mineral;
            }
        }

        return redirect('/')->with(['searchResults' => $searchResults])->withInput();
    }


    
    public function index()
    {
        $bookData = file_get_contents(database_path('minlist.json'));
        $minerals = json_decode($bookData, true);

        $countryData = file_get_contents(database_path('countries.json'));
        $countries = json_decode($countryData, true);


        
        $minerals = Arr::sort($minerals, function ($value) {
            // dd($value['Species']);
            return $value['Species'];
        });


        return view('minerals/index', [
            'minerals' => $minerals,
            'countries' => $countries,
            
            ]);
    }

    public function show($slug)
    {
        $bookData = file_get_contents(database_path('minlist.json'));
        $minerals = json_decode($bookData, true);
        //$minerals = Arr::sort($minerals, function ($value, $key) use ($slug) {
        //   return $value['title'] = $slug;});


        $mineral = Arr::first($minerals, function ($value, $key) use ($slug) {
            return $value['Species']  == $slug;
        });


        
        return view(
            'minerals/show',
            [//'species' => $species,
            'mineral' =>$mineral,
            
            ]
        );
    }


    public function help()
    {
        //dump(config('mail.supportEmail'));


        return view('minerals/help');
    }
}