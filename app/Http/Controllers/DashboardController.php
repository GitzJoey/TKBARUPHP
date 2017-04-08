<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 9:52 PM
 */

namespace App\Http\Controllers;

use Auth;
use Vinkla\Hashids\Facades\Hashids;

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
}