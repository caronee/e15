<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BookController extends Controller
{
    /**
     * GET /books
     * Search based on books/ title/ authors
     */
    



    public function search(Request $request)
    {
        $request->validate([
        'searchTerms' => 'required',
        'searchType' => 'required'

        ]);
        #if validation fails, it will redirect

        $bookData = file_get_contents(database_path('books.json'));
        $books = json_decode($bookData, true);
        $searchType = $request->input('searchType', 'title');
        $searchTerms = $request->input('searchTerms', '');

        $searchResults = [];
        foreach ($books as $slug => $book) {
            if (strtolower($book[$searchType])==strtolower($searchTerms)) {
                $searchResults[$slug] = $book;
            }
        }

        

        return redirect('/') ->with([
            'searchResults' => $searchResults,
     
        
        ])->withInput();
    }

    /**
    * GET /books/create
    * Display the form to add a new book
    */
    public function create(Request $request)
    {
        return view('books/create');
    }


    /**
    * POST /books
    * Process the form for adding a new book
    */
    public function store(Request $request)
    {
        # Code will eventually go here to add the book to the database,
        # but for now we'll just dump the form data to the page for proof of concept
        dump($request->all());
    }


    /**
     * GET /books
     * Show all the books
     */

    public function index()
    {
        // Hard-coded books for practice:
        // $books = [
        //     ['title' => 'War and Peace', 'author' => 'Leo Tolstoy'],
        //     ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald'],
        //     ['title' => 'I Know Why the Caged Bird Sings', 'author' => 'Maya Angelou'],
        // ];

        # Load our book data using PHP's file_get_contents
        # We specify our books.json file path using Laravel's database_path helper
        $bookData = file_get_contents(database_path('books.json'));
        
    
        # Convert the string of JSON text we loaded from books.json into an
        # array using PHP's built-in json_decode function
        $books = json_decode($bookData, true);

        # Alphabetize the books
        $books = Arr::sort($books, function ($value) {
            return $value['title'];
        });

        $countriesData = file_get_contents(database_path('countries.json'));
        $countries = json_decode($countriesData, true);

        return view('books/index', [
            'books' => $books,
            'countries' => $countries
            
            ]);
    }

    /**
     * GET /books/{slug}
     * Show the details for an individual book
     */
    public function show($slug)
    {
        # Load our book data
        # TODO: This code is redundant with loading the books in the index method
        $bookData = file_get_contents(database_path('books.json'));
        $books = json_decode($bookData, true);


        $countriesData = file_get_contents(database_path('countries.json'));
        $countries = json_decode($countriesData, true);


        # Narrow down our array of books
        $book = Arr::first($books, function ($value, $key) use ($slug) {
            return $key == $slug;
        });

        $country = Arr::first($countries, function ($value, $key) use ($slug) {
            return $key == $slug;
        });

        
        return view('books/show', [
            'book' => $book,
            'country' => $country,
        ]);
    }



    /**
     * GET /list
     */
    public function list()
    {
        # TODO
        return view('books/list');
    }


    /**
    public function show2($title)
    {
        $bookFound = true;
        //return $view('books/show');
        return view('books/show2', [
            'title' => $title,
            'bookFound' => $bookFound
        ]);
    }

    public function search2($category, $subcategory)
    {
        return 'books' . $category . ' ' . $subcategory;
    }*/
}