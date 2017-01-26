<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountingCashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('accounting.cash_index');
    }
}
