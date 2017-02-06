<?php

namespace App\Http\Controllers;

use App\Model\AccountingCapitalDeposit;
use App\Model\AccountingCapitalWithdrawal;

use App\Model\AccountingCash;
use Illuminate\Http\Request;

class AccountingCapitalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listDeposit()
    {
        $capdep = AccountingCapitalDeposit::paginate(10);

        return view('accounting.capital.deposit_index', compact('capdep'));
    }

    public function addDeposit()
    {
        $accountDDL = AccountingCash::get()->pluck('name', 'code');
        return view('accounting.capital.deposit', compact('accountDDL'));
    }

    public function saveDeposit()
    {
        return redirect(route('db.acc.capital.deposit.index'));
    }

    public function listWithdrawal()
    {
        $capwith = AccountingCapitalWithdrawal::paginate(10);

        return view('accounting.capital.withdrawal_index', compact('capwith'));
    }

    public function addWithdrawal()
    {
        $accountDDL = AccountingCash::get()->pluck('name', 'code');
        return view('accounting.capital.withdrawal', compact('accountDDL'));
    }

    public function saveWithdrawal()
    {
        return redirect(route('db.acc.capital.withdrawal.index'));
    }
}
