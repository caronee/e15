<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Mineral;
use App\Models\Specimen;
use App\Models\Country;
use App\Models\Repository;

class SpecimenController extends Controller
{
    /**
     * GET /specimens
     * Search based on specimens/ title/ authors
     */
    

    public function edit(Request $request, $slug)
    {
        $specimen = Specimen::where('slug', '=', $slug)->first();
        $countries = Country::orderBy('country')->select(['id','country'])->get();
        $repositories = Repository::orderBy('country_id')->select(['id', 'display_name'])->get();
        $repositories = Repository::with('country')->get();
        $minerals = Specimen::with('mineral')->get();


        if (!$specimen) {
            return redirect('/specimens')->with(['flash-alert' => 'Specimen not found.']);
        }

        return view('specimens/edit', ['specimen' => $specimen,
             'countries'=>$countries,
             'repositories' =>$repositories,
                'minerals'=>$minerals
             ]);
    }
    /**
       * PUT /specimens
       * Process the form for adding a new respository
       */
    public function update(Request $request, $slug)
    {
        $specimen = Specimen::where('slug', '=', $slug)->first();
        


        $request->validate([
        'slug' => 'required',
       // 'display_name' => 'required',
      //  'catalogue_entry'=> 'required',

       // 'type_status'=> 'required'


        ]);
     
        $specimen-> slug= $request-> slug;
        $specimen-> IMA_reference= $request-> IMA_reference;
        $specimen-> repository_id= $request-> repository_id;
        //$specimen-> country= $request-> country;
        $specimen-> country_id= $request-> country_id;
        $specimen-> mineral_id= $request-> mineral_id;

        $specimen-> type_status= $request-> type_status;
        $specimen-> catalogue_entry= $request-> catalogue_entry;
        $specimen-> comments= $request-> comments;

        $specimen->CT = $request-> CT;
        $specimen->T = $request-> T;
        $specimen->HT = $request-> HT;
        $specimen->NT = $request-> NT;
        $specimen->PT = $request-> PT;
        $specimen->AT = $request-> AT;
        // dd($specimen);

        $specimen->save();


        return redirect('/specimens/'.$display_name.'/edit')->with([
            'flash-alert' => 'Your specimen record was changed.']);
    }

    public function search6(Request $request)
    {
        $request->validate([
        'searchTerms' => 'required',
        'searchType' => 'required'

        ]);
        #if validation fails, it will redirect

        $specimen = Specimen::where('slug', '=', $slug)->first();
        $countries = Country::orderBy('country')->select(['id','country'])->get();
        $repositories = Repository::orderBy('country_id')->select(['id', 'display_name'])->get();
        $repositories = Repository::with('country')->get();
        $minerals = Specimen::with('mineral')->get();

        $searchType = $request->input('searchType', 'title');
        $searchTerms = $request->input('searchTerms', '');

        $searchResults = [];
        foreach ($specimens as $slug => $respository) {
            if (strtolower($respository[$searchType])==strtolower($searchTerms)) {
                $searchResults[$slug] = $respository;
            }
        }

        

        return redirect('/pages/search') ->with([
            'searchResults' => $searchResults,
     
        
        ])->withInput();
    }


    /**
     * GET /
     */
    public function search(Request $request)
    {
        $countries = Country::orderBy('country')->select(['id','country'])->get();
        $repositories = Repository::orderBy('country_id')->select(['id', 'display_name'])->get();
        $repositories = Repository::with('country')->get();
        $minerals = Specimen::with('mineral')->get();
       


        # If we land on this page after doing a search, we'll have the following data available
        $searchResults = session('searchResults', null);
      
        return view('pages/search', [
            'searchResults' => $searchResults,
          
            'countries' => $countries,
            'repositories' =>$repositories,
                'minerals'=>$minerals
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

        return redirect('/pages/search')->with(['searchResults' => $searchResults])->withInput();
    }







    /**
    * GET /specimens/create
    * Display the form to add a new respository
    */
    public function create(Request $request)
    {
        $countries = Country::orderBy('country')->select(['id','country'])->get();
        $repositories = Repository::orderBy('country_id')->select(['id', 'display_name'])->get();
        $repositories = Repository::with('country')->get();
        $minerals = Specimen::with('mineral')->get();


        return view('specimens/create', ['countries'=>$countries,
        'repositories'=>$repositories,
           'minerals'=>$minerals
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
        $specimen = new Specimen();
        $specimen-> slug= $request-> slug;
        $specimen-> IMA_reference= $request-> IMA_reference;
        $specimen-> repository_id= $request-> repository_id;
        //$specimen-> country= $request-> country;
        $specimen-> country_id= $request-> country_id;
        $specimen-> mineral_id= $request-> mineral_id;

        $specimen-> type_status= $request-> type_status;
        $specimen-> catalogue_entry= $request-> catalogue_entry;
        $specimen-> comments= $request-> comments;

        $specimen->CT = $request-> CT;
        $specimen->T = $request-> T;
        $specimen->HT = $request-> HT;
        $specimen->NT = $request-> NT;
        $specimen->PT = $request-> PT;
        $specimen->AT = $request-> AT;

        $specimen->save();


        return redirect('/specimens/create')->with([
            'flash-alert' => 'Your specimen record was added.']);
    }


    /**
     * GET /specimens
     * Show all the specimens
     */

    public function index()
    {
        $specimens = Specimen::orderBy('slug')->get();

        // $countries = Country::orderBy('country')->select(['id','country'])->get();
        //  $repositories = Repository::orderBy('country_id')->select(['id', 'display_name'])->get();
        // $minerals = Mineral::orderBy('slug')->select(['id', 'slug'])->get();

        $countries = Specimen::with('country')->get();
        $repositories = Specimen::with('repository')->get();
        $minerals = Specimen::with('mineral')->get();

     



        return view('specimens/index', [
            'specimens' => $specimens,
            'countries' => $countries,
            'repositories'=>$repositories,
                   'minerals'=>$minerals
            ]);
    }

    /**
     * GET /specimens/{slug}
     * Show the details for an individual respository
     */
    public function show($display_name)
    {
        $specimens = Specimen::where('display_name', '=', $display_name)->first();


      
        $countries = Specimen::with('country')->get();
        $repositories = Specimen::with('repository')->get();
        $minerals = Specimen::with('mineral')->get();

        
        return view('specimens/show', [
              'specimens' => $specimens,
            'countries' => $countries,
            'repositories'=>$repositories,
                   'minerals'=>$minerals
        ]);
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
    public function show2($title)
    {
        $respositoryFound = true;
        //return $view('specimens/show');
        return view('specimens/show2', [
            'title' => $title,
            'respositoryFound' => $respositoryFound
        ]);
    }

    public function search2($category, $subcategory)
    {
        return 'specimens' . $category . ' ' . $subcategory;
    }*/
}