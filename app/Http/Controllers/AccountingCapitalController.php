<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountingCapitalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('accounting.capital_index');
    }
}
