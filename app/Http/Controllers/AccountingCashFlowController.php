<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountingCashFlowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('accounting.cash_flow_index');
    }
}
