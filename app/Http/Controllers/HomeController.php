<?php

namespace App\Http\Controllers;

use App;
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
        /*temporary force default language to ID*/
        App::setLocale('id');

        if (!Cookie::has('tkbaruCookie_login')) {
            $cookie = Cookie::make('tkbaruCookie_login', Auth::user()->email, 4320, "/", null, false, false); //3 days

            return redirect('dashboard')->withCookie($cookie);
        } else {
            return redirect('dashboard');
        }
    }
}
