<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Model\AccountingCapitalDeposit;
use App\Model\AccountingCapitalWithdrawal;

use App\Model\AccountingCash;

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
        $accountDDL = AccountingCash::get()->pluck('codeAndName', 'id');
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
            AccountingCapitalDeposit::create([
                'store_id' => Auth::user()->store->id,
                'date' => date('Y-m-d', strtotime($data['date'])),
                'destination_acc_cash_id' => $data['destination_account'],
                'amount' => floatval(str_replace(',', '', $data['amount'])),
                'remarks' => $data['remarks'],
            ]);

            return redirect(route('db.acc.capital.deposit.index'));
        }
    }

    public function listWithdrawal()
    {
        $capwith = AccountingCapitalWithdrawal::paginate(10);

        return view('accounting.capital.withdrawal_index', compact('capwith'));
    }

    public function addWithdrawal()
    {
        $accountDDL = AccountingCash::get()->pluck('codeAndName', 'id');

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
            AccountingCapitalWithdrawal::create([
                'store_id' => Auth::user()->store->id,
                'date' => date('Y-m-d', strtotime($data['date'])),
                'source_acc_cash_id' => $data['source_account'],
                'amount' => floatval(str_replace(',', '', $data['amount'])),
                'remarks' => $data['remarks'],
            ]);

            return redirect(route('db.acc.capital.withdrawal.index'));
        }
    }
}
