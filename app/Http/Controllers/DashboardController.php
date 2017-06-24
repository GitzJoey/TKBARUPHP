<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 9:52 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard');
    }

    public function contributors()
    {
        return "Building.....";
    }

    public function saveNotepad(Request $req)
    {
        $req->session()->put('notepad', $req->data);

        return response()->json();
    }
}