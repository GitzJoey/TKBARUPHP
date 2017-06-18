<?php

namespace App\Http\Controllers\Accounting;

use App\Model\Accounting\CashFlow;
use App\Model\Accounting\CashAccount;

use App\Repos\LookupRepo;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CashFlowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cashflow = CashFlow::paginate(10);

        return view('accounting.cash_flow.index', compact('cashflow'));
    }

    public function show($id)
    {
        $cashflow = CashAccount::find($id);

        return view('accounting.cash_flow.show', compact('cashflow'));
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $dest_acc = CashAccount::get()->pluck('codeAndName', 'id');
        $source_acc = CashAccount::get()->pluck('codeAndName', 'id');

        return view('accounting.cash_flow.create', compact('source_acc', 'dest_acc', 'statusDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'date' => 'required|string|max:255',
            'source_account' => 'required|string|max:255',
            'destination_account' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.acc.cash_flow.create'))->withInput()->withErrors($validator);
        } else {

            return redirect(route('db.acc.cash_flow'));
        }
    }

    public function edit($id)
    {
        $cashflow = CashAccount::find($id);
        $dest_acc = CashAccount::get()->pluck('codeAndName', 'id');
        $source_acc = CashAccount::get()->pluck('codeAndName', 'id');
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');

        return view('accounting.cash_flow.edit', compact('cashflow', 'dest_acc', 'source_acc', 'statusDDL'));
    }

    public function update($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'date' => 'required|string|max:255',
            'source_account' => 'required|string|max:255',
            'destination_account' => 'required|string|max:255',
            'amount' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.acc.cash_flow.edit'))->withInput()->withErrors($validator);
        } else {

            return redirect(route('db.acc.cash_flow'));
        }
    }

    public function delete($id)
    {
        $cashflow = CashAccount::find($id);
        $cashflow->delete();
        return redirect(route('db.acc.cash_flow'));
    }
}
