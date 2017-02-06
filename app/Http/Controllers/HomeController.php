<?php

namespace App\Http\Controllers;

use Auth;
use Cookie;

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
        $cookie = Cookie::make('tkbaruCookie_login', Auth::user()->email, 360, "/", null, false, false); //6 Hours

        return redirect('dashboard')->withCookie($cookie);
    }
}
