<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 10:40 PM
 */

namespace App\Http\Controllers;

use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::paginate(10);
        return view('user.index')->with('user', $user);
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store($data)
    {
        if ($this->validateInput($data)) {
            $usr = new User();
            $usr->name = $data['name'];
            $usr->email = $data['email'];
            $usr->password = bcrypt($data['password']);

            $usr->profile->first_name = $data['first_name'];
            $usr->store_id = 1;
            $usr->role_id = 1;

            $usr->save();
        }

        return redirect(route('db.admin.user'));
    }

    private function validateInput(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }
}