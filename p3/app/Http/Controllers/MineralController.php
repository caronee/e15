<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Mineral;
use App\Models\Repository;
use App\Models\Country;

class MineralController extends Controller
{
    public function welcome()
    {
        return view('pages/welcome', [
 
        ]);
    }

    /**
     * GET /
     */
    public function search()
    {
        # Load countries for dropdown list
        $countries = Country::orderBy('country')->select(['id','country'])->get();

        # If we land on this page after doing a search, we'll have the following data available
        $searchResults = session('searchResults', null);
      
        return view('pages/search', [
            'searchResults' => $searchResults,
            'countries' => $countries,
        ]);
    }

    /**
     * GET /search
     */
    public function search1(Request $request)
    {
        # Validate
        $request->validate([
            'slug' => 'required|alpha',
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
    public function edit(Request $request, $slug)
    {
        $mineral = Mineral::where('slug', '=', $slug)->first();
        $countries = Country::orderBy('country')->select(['id','country'])->get();

        if (!$mineral) {
            return redirect('/minerals')->with(['flash-alert' => 'Mineral not found.']);
        }

        return view('minerals/edit', ['mineral' => $mineral,
         'countries'=>$countries]);
    }
    /**
       * PUT /minerals
       * Process the form for adding a new respository
       */
    public function update(Request $request, $slug)
    {
        $mineral = Mineral::where('slug', '=', $slug)->first();
        


        $request->validate([
        'slug' => 'required',
       // 'slug' => 'required',
      //  'catalogue_entry'=> 'required',
        'country_id' =>'required'
       // 'type_status'=> 'required'


        ]);
     
        $mineral-> slug= $request-> slug;
        $mineral-> formula= $request-> formula;
        $mineral-> country_id= $request-> country_id;
        $mineral-> locality= $request-> locality;

        $mineral-> comments= $request-> comments;


        $mineral->save();


        return redirect('/minerals/'.$slug.'/edit')->with([
            'flash-alert' => 'Your mineral record was changed.']);
    }

    /**
    * GET /specimens/create
    * Display the form to add a new respository
    */
    public function create(Request $request)
    {
        $countries = Country::orderBy('country')->select(['id','country'])->get();
        $repositories = Repository::orderBy('country_id')->select(['id','display_name'])->get();


        return view('minerals/create', ['countries'=>$countries,
        'repositories' => $repositories
        
        ]);
    }

    /**
    * POST /specimens
    * Process the form for adding a new respository
    */
    public function store(Request $request)
    {
        $request->validate([
        'slug' => 'required',
       // 'display_name' => 'required',
      //  'catalogue_entry'=> 'required',
        'country_id' =>'required'
       // 'type_status'=> 'required'


        ]);
        $specimen = new Mineral();
        $specimen-> slug= $request-> slug;
        $specimen-> IMA_reference= $request-> IMA_reference;
        $specimen-> author= $request-> author;
        //$specimen-> country= $request-> country;
        $specimen-> country_id= $request-> country_id;
        
        $specimen-> published_year= $request-> published_year;
        $specimen-> publication= $request-> publication;
        $specimen-> formula= $request-> formula;
        $specimen-> locality= $request-> locality;
        $specimen-> publication_url= $request-> publication_url;

        $specimen-> comments= $request-> comments;




        $specimen->save();


        return redirect('/minerals/'.$request->slug.'/edit')->with([
            'flash-alert' => 'Your specimen record was added.']);
    }


    
    public function index()
    {
        $minerals = Mineral::orderBy('slug')->get();
        // $countries = Country::orderBy('country')->select(['id','country'])->get();

        $countries = Country::orderBy('country')->select(['id','country'])->get();

        // $countries = Country::orderBy('country')->get();

        $minerals = Mineral::with('country')->get();

        return view('minerals/index', [
            'minerals' => $minerals,
            'countries' => $countries,
            
            ]);
    }

    public function show($slug)
    {
        $mineral = Mineral::where('slug', '=', $slug)->get();

            
        $country = Country::orderBy('country')->get();

        return view(
            'minerals/show',
            [//'species' => $species,
            'mineral' =>$mineral,
            'country' => $country,
            ]
        );
    }


    public function help()
    {
        //dump(config('mail.supportEmail'));


        return view('minerals/help');
    }

    
    /**
     * GET /list
     */
    public function list()
    {
        # TODO
        return view('specimens/list');
    }

    /**
    * Asks user to confirm they want to delete the mineral
    * GET /minerals/{slug}/delete
    */
    public function delete($slug)
    {
        $mineral = Mineral::findBySlug($slug);

        if (!$mineral) {
            return redirect('/minerals')->with([
                'flash-alert' => 'mineral not found'
            ]);
        }

        return view('minerals/delete', ['mineral' => $mineral]);
    }

    /**
    * Deletes the mineral
    * DELETE /minerals/{slug}/delete
    */
    public function destroy($slug)
    {
        $mineral = Mineral::findBySlug($slug);

        //$mineral->users()->detach();

        // $mineral->delete();

        return redirect('/minerals')->with([
            'flash-alert' => '“' . $mineral->slug . '” was removed.'
        ]);
    }
}