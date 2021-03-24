<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return 'books';
    }

    public function show($title)
    {
        $bookFound = true;
        //return $view('books/show');
        return view('books/show', [
            'title' => $title,
            'bookFound' => $bookFound
        ]);
    }
    
    public function search($category, $subcategory)
    {
        return 'books' . $category . ' ' . $subcategory;
    }
}