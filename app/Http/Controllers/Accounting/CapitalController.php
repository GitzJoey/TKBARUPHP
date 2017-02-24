<?php

namespace App\Http\Controllers\Accounting;


use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Accounting\CashAccount;
use App\Model\Accounting\CapitalDeposit;
use App\Model\Accounting\CapitalWithdrawal;

class CapitalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listDeposit()
    {
        $capdep = CapitalDeposit::paginate(10);

        return view('accounting.capital.deposit_index', compact('capdep'));
    }

    public function addDeposit()
    {
        $accountDDL = CashAccount::get()->pluck('codeAndName', 'id');
        return view('accounting.capital.deposit', compact('accountDDL'));
    }

    public function saveDeposit(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'date' => 'required',
            'destination_account' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.acc.capital.deposit.create'))->withInput()->withErrors($validator);
        } else {
            CapitalDeposit::create([
                'store_id' => Auth::user()->store->id,
                'date' => date('Y-m-d', strtotime($data['date'])),
                'destination_cash_account_id' => $data['destination_account'],
                'amount' => floatval(str_replace(',', '', $data['amount'])),
                'remarks' => $data['remarks'],
            ]);

            return redirect(route('db.acc.capital.deposit.index'));
        }
    }

    public function listWithdrawal()
    {
        $capwith = CapitalWithdrawal::paginate(10);

        return view('accounting.capital.withdrawal_index', compact('capwith'));
    }

    public function addWithdrawal()
    {
        $accountDDL = CashAccount::get()->pluck('codeAndName', 'id');

        return view('accounting.capital.withdrawal', compact('accountDDL'));
    }

    public function saveWithdrawal(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'date' => 'required',
            'source_account' => 'required',
            'amount' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.acc.capital.withdrawal.create'))->withInput()->withErrors($validator);
        } else {
            CapitalWithdrawal::create([
                'store_id' => Auth::user()->store->id,
                'date' => date('Y-m-d', strtotime($data['date'])),
                'source_cash_account_id' => $data['source_account'],
                'amount' => floatval(str_replace(',', '', $data['amount'])),
                'remarks' => $data['remarks'],
            ]);

            return redirect(route('db.acc.capital.withdrawal.index'));
        }
    }
}