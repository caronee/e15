<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * GET /
     */
    public function index()
    {
        return view('pages/welcome');
    }

    /**
     * GET /support
     */
    public function support()
    {
        return view('pages/support');
    }
}