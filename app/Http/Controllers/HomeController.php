<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('welcome');
    }

    public function about(): View
    {
        return view('about.index');
    }

    public function contact(): View
    {
        return view('contact.index');
    }
}
