<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Model\Role;
use App\Model\Store;
use App\Model\Lookup;
use App\Model\UserDetail;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Services\StoreService;

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

        $usr->roles()->attach(Role::where('name', '=', 'r_user')->get());

        $userdetail = new UserDetail();
        $userdetail->allow_login = true;
        $userdetail->type = Lookup::whereCode('USERTYPE.U')->first()->code;
        $usr->userDetail()->save($userdetail);

        return $usr;
    }

    /**
     * Override the RegistersUsers@showRegistrationForm
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        $store_mode = '';
        $storeDDL = $this->storeService->getAllStore();
        $store_id = 0;

        if ($this->storeService->isEmptyStoreTable()) {
            $store_mode = 'create';
        } else {
            if ($this->storeService->defaultStorePresent()) {
                $store_mode = 'use_default';
                $store_id = $this->storeService->getDefaultStore()->id;
            } else {
                $store_mode = 'store_pick'; //this should never happen
            }
        }

        return view('auth.register', compact('store_mode', 'storeDDL', 'store_id'));
    }
}
