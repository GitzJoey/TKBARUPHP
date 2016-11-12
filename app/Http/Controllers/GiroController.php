<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 11/12/2016
 * Time: 1:37 PM
 */

namespace App\Http\Controllers;

use Vinkla\Hashids\Facades\Hashids;

use App\Model\Giro;

class GiroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard');
    }
}