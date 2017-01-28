<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\AccountingCash;

use App\Repos\LookupRepo;

class AccountingCashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $acccash = AccountingCash::paginate(10);

        return view('accounting.cash.index', compact('acccash'));
    }

    public function show($id)
    {
        $acccash = AccountingCash::find($id);

        return view('accounting.cash.show', compact('acccash'));
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');

        return view('accounting.cash.create', compact('statusDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.acc.cash.create'))->withInput()->withErrors($validator);
        } else {
            AccountingCash::create([
                'name' => $data['name'],
                'code' => $data['code'],
                'status' => $data['status'],
                'is_default' => $data['is_default'],
            ]);

            return redirect(route('db.acc.cash'));
        }
    }

    public function edit($id)
    {
        $acccash = AccountingCash::find($id);

        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');

        return view('accounting.cash.edit', compact('acccash', 'statusDDL'));
    }

    public function update($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.acc.cash.edit'))->withInput()->withErrors($validator);
        } else {
            AccountingCash::find($id)->update($req->all());
            return redirect(route('db.acc.cash'));
        }
    }

    public function delete($id)
    {
        AccountingCash::find($id)->delete();
        return redirect(route('db.acc.cash'));
    }
}
