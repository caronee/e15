<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Book;

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
* GET /books/{slug}/edit
*/
    public function edit(Request $request, $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        if (!$book) {
            return redirect('/books')->with(['flash-alert' => 'Book not found.']);
        }
        dump($book->description);
        return view('books/edit', ['book' => $book]);
    }

    /**
        * PUT /books
        */
    public function update(Request $request, $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        $request->validate([
        'title' => 'required',
        'slug' => 'required|unique:books,slug,'.$book->id.'|alpha_dash',
        'author' => 'required',
        'published_year' => 'required|digits:4',
        'cover_url' => 'url',
        'info_url' => 'url',
        'purchase_url' => 'required|url',
        'description' => 'min:2'
    ]);

        // dump($book->description);
        $book->title = $request->title;
        $book->slug = $request->slug;
        $book->author = $request->author;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->info_url = $request->info_url;
        $book->purchase_url = $request->purchase_url;
        $book->description = $request->description;
        $book->save();

        return redirect('/books/'.$slug.'/edit')->with(['flash-alert' => 'Your changes were saved.']);
    }





    
    /**
    * POST /books
    * Process the form for adding a new book
    */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'author'=> 'required|max:255',
            'published_year'=> 'required|digits:4',
            'slug'=> 'required|unique:books,slug',
            'cover_url' => 'required|url',
            'info_url' => 'required|url',
            'purchase_url' => 'required|url',
             'description'=> 'required|max:255',

        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->slug = $request->slug;

        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->info_url = $request->info_url;
        $book->purchase_url = $request->purchase_url;

        $book->description = $request->description;
        $book->save();


        # Code will eventually go here to add the book to the database,
        # but for now we'll just dump the form data to the page for proof of concept
        #dump($book);
        return redirect('/books/create')->with(['flas-alert' => 'Your book was added.']);
    }


    /**
     * GET /books
     * Show all the books
     */

    public function index()
    {
        $books = Book::orderBy('title', 'ASC')->get();
        $newBooks = $books-> sortByDesc('id')->take(3);
       
       
        //$newBooks = Book::orderBy('id', 'DESC')->limit(3)->get();
        //dd($books->count());
        return view('books/index', ['books' => $books, 'newBooks'=>$newBooks]);
    }

    /**
     * GET /books/{slug}
     * Show the details for an individual book
     */
    public function show($slug)
    {
        $book = Book::where('slug', '=', $slug)->first();


        # Load our book data
        # TODO: This code is redundant with loading the books in the index method
        /*   $bookData = file_get_contents(database_path('books.json'));
          $books = json_decode($bookData, true);

          # Narrow down our array of books
          $book = Arr::first($books, function ($value, $key) use ($slug) {
              return $key == $slug;
          });
           */
        return view('books/show', [
            'book' => $book,
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