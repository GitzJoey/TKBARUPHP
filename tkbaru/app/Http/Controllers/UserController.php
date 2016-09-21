<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 10:40 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Validator;

use App\User;
use App\Role;
use App\Store;
use App\Profile;
use App\Lookup;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::paginate(10);
        return view('user.index', compact('user'));
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    public function profile($id)
    {
        $user = User::find($id);
        return view('user.profile', compact('user'));
    }

    public function create()
    {
        $rolesDDL = Role::get()->pluck('display_name', 'name');
        $storeDDL = Store::get()->pluck('name', 'id');
        $usertypeDDL = Lookup::whereCategory('USERTYPE')->pluck('description', 'code');

        return view('user.create', compact('rolesDDL', 'storeDDL', 'usertypeDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required',
            'store' => 'required',
            'image_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.admin.user.create'))->withInput()->withErrors($validator);
        } else {
            $imageName = time().'.'.$data->image_path->getClientOriginalExtension();
            $data->image_path->move(public_path('images'), $imageName);

            $usr = new User();
            $usr->name = $data['name'];
            $usr->email = $data['email'];
            $usr->password = bcrypt($data['password']);
            $usr->store_id = 1;
            $usr->role_id = 1;

            $usr->save();

            Session::flash('success', 'New User Created');

            return redirect(route('db.admin.user'));
        }
    }

    public function edit($id)
    {
        $user = User::find($id);

        $rolesDDL = Role::get()->pluck('display_name', 'name');
        $storeDDL = Store::get()->pluck('name', 'id');

        return view('user.edit', compact('user', 'storeDDL', 'rolesDDL'));
    }

    public function update($id, Request $req)
    {
        $this->validate($req, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required',
            'store' => 'required',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'address' => 'required|max:255',
        ]);

        User::find($id)->update($req->all());
        return redirect(route('db.admin.user'));
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->userDetail()->update(['allow_login' => 0]);

        return redirect(route('db.admin.user'));
    }
}