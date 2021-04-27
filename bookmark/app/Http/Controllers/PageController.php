<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        $searchResults = session('searchResults', null);
        



        return view('pages/welcome', [
            'searchResults' => $searchResults,
            
        ]);
    }
    /**
    * GET /support
    */
    public function support()
    {
        return view('pages/support');
    }
}