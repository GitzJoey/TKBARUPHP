<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountingCostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('accounting.cost_index');
    }
}
