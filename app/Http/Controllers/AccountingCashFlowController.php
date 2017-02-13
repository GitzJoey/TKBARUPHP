<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Http\Request;

class AccountingCashFlowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('accounting.cash_flow.index');
    }

    public function show($id)
    {
        $cashflow = [];

        return view('accounting.cash_flow.show', compact('cashflow'));
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');
        $dest_acc = [];
        $source_acc = [];

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
        $cashflow = [];
        $dest_acc = [];
        $source_acc = [];
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');

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

        return redirect(route('db.acc.cash_flow'));
    }
}
