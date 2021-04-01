<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class MineralController extends Controller
{

    /**get method / search
     * search minerals
     */

    public function welcome()
    {
        $countryData = file_get_contents(database_path('countries.json'));
        $countries = json_decode($countryData, true);

        # If we land on this page after doing a search, we'll have the following data available
        $searchResults = session('searchResults', null);
      



        return view('minerals/welcome', [
            'searchResults' => $searchResults,
                  'countries' => $countries,
             
        ]);
    }

    public function search(Request $request)
    {
        $countryData = file_get_contents(database_path('countries.json'));
        $countries = json_decode($countryData, true);

        
        $request->validate([
        'element' => 'max:2 | alpha',
        'searchType' => 'alpha'

        ]);
        #if validation fails, it will redirect
        $bookData = file_get_contents(database_path('minlist.json'));
        $minerals = json_decode($bookData, true);


        $searchType = $request->input('searchType', 'Species');
        $searchPlace = $request->input('Locality', 'Country');
        $searchElement = $request->input('element1', 'Formula');


        $rmType = $request->input('rmType', 'Valid');
        $searchTerms = $request->input('searchTerms', '');
        
        $Locality = $request->input('Locality1', '');
        $minRock = $request->input('minRock', '');
        $element = $request->input('element', '');




        $searchResults = [];

  


        foreach ($minerals as $slug => $mineral) {
            
            //element
            if (!empty($element)) {
                if (strpos($mineral[$searchElement], strval($element)) !== false) {
                    if (!empty($searchTerms)) {
                        if ($mineral[$rmType] == $minRock&& $mineral[$searchType]==$searchTerms) {
                            if (!empty($Locality)) {
                                if ($mineral[$searchPlace] == $Locality) {
                                    $searchResults[$slug] = $mineral;
                                }
                            } else {
                                $searchResults[$slug] = $mineral;
                            }
                        }
                    } else {
                        if ($mineral[$rmType] == $minRock) {
                            if (!empty($Locality)) {
                                if ($mineral[$searchPlace] == $Locality) {
                                    $searchResults[$slug] = $mineral;
                                }
                            } else {
                                $searchResults[$slug] = $mineral;
                            }
                        }
                    }
                }
                //dump($mineral[$searchElement].$element. $mineral[$rmType].$minRock . $searchTerms . $Locality);

                // dump($request->all());
            }
            //if search term matches specific mineral
            if (empty($element)) {
                if (!empty($searchTerms)) {
                    if ($mineral[$rmType] == $minRock&& $mineral[$searchType]==$searchTerms) {
                        if (!empty($Locality)) {
                            if ($mineral[$searchPlace] == $Locality) {
                                $searchResults[$slug] = $mineral;
                            }
                        } else {
                            $searchResults[$slug] = $mineral;
                        }
                    }
                } else {
                    if ($mineral[$rmType] == $minRock) {
                        if (!empty($Locality)) {
                            if ($mineral[$searchPlace] == $Locality) {
                                $searchResults[$slug] = $mineral;
                            }
                        } else {
                            $searchResults[$slug] = $mineral;
                        }
                    }
                }
                //dump($minRock . $searchTerms . $Locality);
                //dump($request->all());
            }
        }
        //dd($element);


        return redirect('/')->with([
            'searchResults' =>$searchResults,

            ])->withInput();
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
        # TODO
        return view('/help');
    }
}