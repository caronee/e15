<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Mineral;
use App\Models\Repository;
use App\Models\Country;

class RepositoryController extends Controller
{
    /**
     * GET /repositories
     * Search based on repositories/ title/ authors
     */
    

    public function edit(Request $request, $display_name)
    {
        $repository = Repository::where('display_name', '=', $display_name)->first();
        $countries = Country::orderBy('country')->select(['id','country'])->get();

        if (!$repository) {
            return redirect('/repositories')->with(['flash-alert' => 'Repository not found.']);
        }

        return view('repositories/edit', ['repository' => $repository,
         'countries'=>$countries]);
    }
    /**
       * PUT /repositories
       * Process the form for adding a new respository
       */
    public function update(Request $request, $display_name)
    {
        $repository = Repository::where('display_name', '=', $display_name)->first();
        


        $request->validate([
        'slug' => 'required',
        'display_name' => 'required',
      //  'catalogue_entry'=> 'required',
        'country_id' =>'required'
       // 'type_status'=> 'required'


        ]);
     
        $repository-> slug= $request-> slug;
        $repository-> display_name= $request-> display_name;
        $repository-> country_id= $request-> country_id;

        $repository-> comments= $request-> comments;


        $repository->save();


        return redirect('/repositories/'.$display_name.'/edit')->with([
            'flash-alert' => 'Your repository record was changed.']);
    }

    public function search(Request $request)
    {
        $request->validate([
        'searchTerms' => 'required',
        'searchType' => 'required'

        ]);
        #if validation fails, it will redirect

        $respositoryData = file_get_contents(database_path('repositories.json'));
        $repositories = json_decode($respositoryData, true);
        $searchType = $request->input('searchType', 'title');
        $searchTerms = $request->input('searchTerms', '');

        $searchResults = [];
        foreach ($repositories as $slug => $respository) {
            if (strtolower($respository[$searchType])==strtolower($searchTerms)) {
                $searchResults[$slug] = $respository;
            }
        }

        

        return redirect('/') ->with([
            'searchResults' => $searchResults,
     
        
        ])->withInput();
    }

    /**
    * GET /repositories/create
    * Display the form to add a new respository
    */
    public function create(Request $request)
    {
        $countries = Country::orderBy('country')->select(['id','country'])->get();

        

        return view('repositories/create', ['countries'=>$countries]);
    }

   
    /**
    * POST /repositories
    * Process the form for adding a new respository
    */
    public function store(Request $request)
    {
        $request->validate([
        'slug' => 'required|unique:repositories,slug',
       'display_name' => 'required',
      //  'catalogue_entry'=> 'required',
        'country_id' =>'required'
       // 'type_status'=> 'required'


        ]);
        $repository = new Repository();
        $repository-> slug= $request-> slug;
        $repository-> display_name= $request-> display_name;
        $repository-> country_id= $request-> country_id;
        $repository-> comments= $request-> comments;

   

        $repository->save();


        return redirect('/repositories/create')->with([
            'flash-alert' => 'Your repository record was added.']);
    }


    /**
     * GET /repositories
     * Show all the repositories
     */

    public function index()
    {
        $repositories = Repository::orderBy('slug')->get();

        $countries = Country::orderBy('country')->select(['id','country'])->get();

        // $countries = Country::orderBy('country')->get();

        $repositories = Repository::with('country')->get();

 


        return view('repositories/index', [
            'repositories' => $repositories,
            'countries' => $countries
            
            ]);
    }

    /**
     * GET /repositories/{slug}
     * Show the details for an individual respository
     */
    public function show($display_name)
    {
        $repository = Repository::where('display_name', '=', $display_name)->first();


        
        $country = Country::orderBy('country')->get();

        
        return view('repositories/show', [
            'repository' => $repository,
            'country' => $country,
        ]);
    }



    /**
     * GET /list
     */
    public function list()
    {
        # TODO
        return view('repositories/list');
    }


    /**
    public function show2($title)
    {
        $respositoryFound = true;
        //return $view('repositories/show');
        return view('repositories/show2', [
            'title' => $title,
            'respositoryFound' => $respositoryFound
        ]);
    }

    public function search2($category, $subcategory)
    {
        return 'repositories' . $category . ' ' . $subcategory;
    }*/
}