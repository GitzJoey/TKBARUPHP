<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 9:52 PM
 */

namespace App\Http\Controllers;

use Session;
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

    public function tour()
    {
        return view('dashboard');
    }

    public function contributors()
    {
        return "Building.....";
    }

    public function saveNotepad(Request $req)
    {
        Session::setId(decrypt($req->sessionId));
        Session::start();
        Session::put('notepad', $req->data);
        Session::save();

        return response()->json();
    }
}