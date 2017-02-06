<?php

namespace App\Http\Controllers\Auth;

use App\Services\DatabaseService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    private $databaseService;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(DatabaseService $databaseService)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->databaseService = $databaseService;
    }

    public function showLoginForm()
    {
        if (!$this->databaseService->isOnline()) {
            return "Database Is Not Online";
        }

        return view('auth.login');
    }
}
