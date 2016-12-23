<?php

namespace App\Http\Controllers;

use Auth;
use Cookie;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Cookie::has('tkbaruCookie_login')) {
            Cookie::queue('tkbaruCookie_login', Auth::user()->email, 4320); //3 days
        }

        return redirect('dashboard');
    }
}
