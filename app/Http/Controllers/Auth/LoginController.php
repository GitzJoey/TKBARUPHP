<?php

namespace App\Http\Controllers\Auth;

use App\User;

use App\Services\DatabaseService;

use Carbon\Carbon;
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

        Validator::extend('is_activated', function($attribute, $value, $parameters, $validator) {
            $usr = User::with('userDetail')->where('email', '=', $value);
            if (count($usr->first()) == 0) return true;

            if (!env('MAIL_USER_ACTIVATION', false)) return true;

            if ($usr->first()->active) return true;
            else return false;
        });

        $this->validate($request, [
            $this->username() => 'required|string|is_allowed_login|is_activated',
            'password' => 'required|string',
        ], [
            $this->username().'.is_allowed_login' => LaravelLocalization::getCurrentLocale() == 'en' ? 'Login Not Allowed':'Tidak Diperkenankan Login',
            $this->username().'.is_activated' => LaravelLocalization::getCurrentLocale() == 'en' ? 'Email Has Not Been Activated':'Email Belum Di Aktivasi'
            ]);
    }

    protected function authenticated(Request $request, $user)
    {
        if (Carbon::now()->diffInDays($user->updated_at) > 3) {
            $user->updated_at = Carbon::now();
            $user->api_token = str_random(60);
            $user->save();
        }
    }
}
