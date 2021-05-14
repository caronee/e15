<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Formula;

use App\Models\Mineral;
use App\Models\Repository;

class PracticeController extends Controller
{
    public function practice10()
    {

# Eager load the country with the repository
        $repositories = Repository::with('country')->get();

        foreach ($repositories as $repository) {
            if ($repository->country) {
                dump($repository->country->country.' wrote '.$repository->slug);
            } else {
                dump($repository->slug. ' has no country associated with it.');
            }
        }

        dump($repositories->toArray());
    }


    public function practice9()
    {
        $country = Country::where('country', '=', 'USA')->first();

        $repository = new Repository();
        $repository-> slug= "slug";
        $repository-> IMA_reference= "IMA_reference";
        $repository-> display_name= "display_name";
        $repository-> country()-> associate($country);
        $repository-> type_status= "type_status";
        $repository-> catalogue_entry= "catalogue_entry";
        $repository-> comments= "comments";

        $repository->CT = 0;
        $repository->T = 1;
        $repository->HT = 0;
        $repository->NT = 0;
        $repository->PT = 1;
        $repository->AT = 1;

        $repository->save();
        dump($repository->toArray());
    }


    public function practice5()
    {
        $results = Repository::all();
        foreach ($results as $result) {
            // $result->slug = '';
            dump($result);
        }
    }



    public function practice4()
    {
        $results = Mineral::all();
        foreach ($results as $result) {
            // $result->slug = '';
            dump($result);
        }
    }


    public function practice2()
    {
        $results = Mineral::first();

        dump($results);
    }

    public function practice3()
    {
        $results = Mineral::where('slug', '=', 'azurite')->get();
        //foreach ($results as $result)
        //    $result->slug = ''

        dump($results);
    }


    /**
     * First practice example
     * GET /practice/1
     */
    public function practice1()
    {
        dump('This is the first example.');
    }

    /**
     * ANY (GET/POST/PUT/DELETE)
     * /practice/{n?}
     * This method accepts all requests to /practice/ and
     * invokes the appropriate method.
     * http://e15repositorymark.loc/practice => Shows a listing of all practice routes
     * http://e15repositorymark.loc/practice/1 => Invokes practice1
     * http://e15repositorymark.loc/practice/5 => Invokes practice5
     * http://e15repositorymark.loc/practice/999 => 404 not found
     */
    public function index(Request $request, $n = null)
    {
        $methods = [];

        # Load the requested `practiceN` method
        if (!is_null($n)) {
            $method = 'practice' . $n; # practice1

            # Invoke the requested method if it exists; if not, throw a 404 error
            return (method_exists($this, $method)) ? $this->$method($request) : abort(404);
        } # If no `n` is specified, show index of all available methods
        else {
            # Build an array of all methods in this class that start with `practice`
            foreach (get_class_methods($this) as $method) {
                if (strstr($method, 'practice')) {
                    $methods[] = $method;
                }
            }

            # Load the view and pass it the array of methods
            return view('practice')->with(['methods' => $methods]);
        }
    }
}