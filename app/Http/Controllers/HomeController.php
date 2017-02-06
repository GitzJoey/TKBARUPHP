<?php

namespace App\Http\Controllers;

use Auth;
use Cookie;

use App\Services\DatabaseService;

class HomeController extends Controller
{
    private $databaseService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DatabaseService $databaseService)
    {
        //$this->middleware('auth');
        $this->databaseService = $databaseService;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!$this->databaseService->isOnline()) {
            return "Database Is Not Online";
        }

        $cookie = Cookie::make('tkbaruCookie_login', Auth::user()->email, 360, "/", null, false, false); //6 Hours

        return redirect('dashboard')->withCookie($cookie);
    }
}
