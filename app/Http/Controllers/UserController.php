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
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
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