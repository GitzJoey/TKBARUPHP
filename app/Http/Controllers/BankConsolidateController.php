<?php

namespace App\Http\Controllers;

use App\Model\BankConsolidate;

use Config;
use Illuminate\Http\Request;

class BankConsolidateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bankConsolidates = BankConsolidate::paginate(Config::get('const.PAGINATION'));
        return view('bank.consolidate.index', compact('bankConsolidates'));
    }
}
