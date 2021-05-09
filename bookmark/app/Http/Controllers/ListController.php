<?php

namespace App\Http\Controllers;

use App\Models\Book;


use Illuminate\Http\Request;

class ListController extends Controller
{
   

    /**
     * GET /list
     */
    public function show(Request $request)
    {
        $books = $request->user()->books->sortByDesc('pivot.created_at');

        return view('list/show', ['books' => $books]);
    }

    /**
     * GET /list/{slug}/add
     */
    public function add(Request $request, $slug)
    {
        $book = Book::findBySlug($slug);


        return view('list/add', ['book' => $book]);
    }

    /**
     * POST /list/{slug}/save
     */
    public function save(Request $request, $slug)
    {


        #dump($request->all());
        $user = $request->user();
        $books = Book::findBySlug($slug);
        $user->books()->save($book, ['notes' => $request->notes]);

        return redirect('/list')->with(['flash-alert' => 'books'. $books-> title. 'was added.']);
    }
}