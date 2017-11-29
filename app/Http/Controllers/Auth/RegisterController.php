<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Model\Role;
use App\Model\Store;
use App\Model\Lookup;
use App\Model\UserDetail;

use Session;
use Validator;
use Carbon\Carbon;
use LaravelLocalization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Services\StoreService;

use App\Events\Auth\UserActivationEmail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    private $storeService;

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
    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        $usr = new User;
        $usr->name = $data['name'];
        $usr->email = $data['email'];
        $usr->password = bcrypt($data['password']);

        $usr->api_token = str_random(60);

        if (env('MAIL_USER_ACTIVATION', false)) {
            $usr->active = false;
            $usr->activation_token = str_random(60);
        } else {
            $usr->active = true;
        }

        $usr->created_at = Carbon::now();
        $usr->updated_at = Carbon::now();

        if (!empty($data['store_name'])) {
            $id = $this->storeService->createDefaultStore($data['store_name']);
            $usr->store_id = $id;
        } else if (!empty($data['store_id'])) {
            $usr->store_id = $data['store_id'];
        } else if (!empty($data['picked_store_id'])) {
            $this->storeService->setDefaultStore($data['picked_store_id']);
            $usr->store_id = $data['picked_store_id'];
        } else {

        }

        $usr->save();

        if (!empty($data['store_name'])) {
            $usr->roles()->attach(Role::where('name', 'admin')->get());
        } else {
            $usr->roles()->attach(Role::where('name', 'user')->get());
        }

        $userdetail = new UserDetail();
        $userdetail->allow_login = true;
        $userdetail->type = !empty($data['store_name']) ?
            Lookup::whereCode('USERTYPE.A')->first()->code : Lookup::whereCode('USERTYPE.U')->first()->code;
        $usr->userDetail()->save($userdetail);

        return $usr;
    }

    /**
     * Override the RegistersUsers@showRegistrationForm
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm(Request $req)
    {
        $storeDDL = $this->storeService->getAllStore();
        $store_id = 0;
        $store_name = '';

        if (!empty($req->query('store_mode'))) {
            if ($req->query('store_mode') == 'create') {
                $store_mode = 'create';
            } else if ($req->query('store_mode') == 'store_pick' && !$this->storeService->isEmptyStoreTable()) {
                $store_mode = 'store_pick';
            } else {
                if ($this->storeService->isEmptyStoreTable()) {
                    $store_mode = 'create';
                } else if ($this->storeService->defaultStorePresent()) {
                    $store_mode = 'use_default';
                    $store_id = $this->storeService->getDefaultStore()->id;
                    $store_name = $this->storeService->getDefaultStore()->name;
                } else {
                    $store_mode = 'store_pick';
                }
            }
        } else {
            if ($this->storeService->isEmptyStoreTable()) {
                $store_mode = 'create';
            } else if ($this->storeService->defaultStorePresent()) {
                $store_mode = 'use_default';
                $store_id = $this->storeService->getDefaultStore()->id;
                $store_name = $this->storeService->getDefaultStore()->name;
            } else {
                $store_mode = 'store_pick';
            }
        }

        return view('auth.register', compact('store_mode', 'storeDDL', 'store_id', 'store_name'));
    }

    protected function registered(Request $request, $user)
    {
        if (env('MAIL_USER_ACTIVATION', false)) {
            event(new UserActivationEmail($user));

            $this->guard()->logout();

            return redirect()->route('login')->withSuccess(
                LaravelLocalization::getCurrentLocale() == 'id' ?
                    'Harap Cek Email Untuk Aktivasi':
                    'Please Check Your Email For Activation'
            );
        }
    }

    protected function activate(Request $request, $token)
    {
        $usr = User::whereActivationToken($token)->first();

        if (count($usr) > 0) {
            $usr->active = true;
            $usr->save();

            Session::flash('success', LaravelLocalization::getCurrentLocale() == 'id' ?
                'Akun Anda Sudah Diaktifkan':
                'Your Account Successfully Activated.');

            return view('auth.login');
        } else {
            Session::flash('error', LaravelLocalization::getCurrentLocale() == 'id' ?
                'Kode Aktivasi Salah Atau Tidak Ditemukan':
                'Activation Code Is Invalid Or Not Found');

            return view('auth.passwords.activate');
        }
    }

    protected function activateResend(Request $request)
    {
        $usr = User::whereEmail($request->email)->first();

        if (count($usr) > 0) event(new UserActivationEmail($usr));

        return view('auth.login');
    }
}
