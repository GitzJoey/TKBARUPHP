<?php

namespace App\Http\Controllers\Auth;

use App\User;

use App\Services\DatabaseService;

use Validator;
use LaravelLocalization;
use Illuminate\Http\Request;
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

        if (isset($_SERVER['HTTP_USER_AGENT']) &&
            (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/') !== false)) {
            return "Internet Explorer Browser Is Not Supported";
        }

        return view('auth.login');
    }

    protected function validateLogin(Request $request)
    {
        Validator::extend('is_allowed_login', function($attribute, $value, $parameters, $validator) {
            $usr = User::with('userDetail')->where('email', '=', $value);
            if (count($usr->first()) == 0) return true;

            if ($usr->first()->userDetail->allow_login) return true;
            else return false;
        });

        $this->validate($request, [
            $this->username() => 'required|string|is_allowed_login',
            'password' => 'required|string',
        ], [$this->username().'.is_allowed_login' => LaravelLocalization::getCurrentLocale() == 'en' ? 'Login Not Allowed':'Tidak Diperkenankan Login']);
    }
}
