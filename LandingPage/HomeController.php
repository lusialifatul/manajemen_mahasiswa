<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\History;
// use Illuminate\Http\Request;
use Illuminate\View\view;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about.index');
    }

    public function contact()
    {
        return view('contact.index');
    }
}
