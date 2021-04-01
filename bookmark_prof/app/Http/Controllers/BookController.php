<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class BookController extends Controller
{
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

        return view('books/index', ['books' => $books]);
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

        # Narrow down our array of books
        $book = Arr::first($books, function ($value, $key) use ($slug) {
            return $key == $slug;
        });
        
        return view('books/show', [
            'book' => $book,
        ]);
    }

    /**
     * GET /search/{category}/{subcategory}
     */
    public function search($category, $subcategory)
    {
        # TODO: Query the db for books in these categories
        # TODO: Return a view instead of a string
        return 'Search in: '.$category.', '.$subcategory;
    }

    /**
     * GET /list
     */
    public function list()
    {
        # TODO
        return view('books/list');
    }
}