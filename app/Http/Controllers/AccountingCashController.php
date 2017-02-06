<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
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
        $typeDDL = LookupRepo::findByCategory('ACCCASH')->pluck('i18nDescription', 'code');

        return view('accounting.cash.index', compact('acccash', 'typeDDL'));
    }

    public function show($id)
    {
        $acccash = AccountingCash::find($id);

        return view('accounting.cash.show', compact('acccash'));
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');
        $typeDDL = LookupRepo::findByCategory('ACCCASH')->pluck('i18nDescription', 'code');

        return view('accounting.cash.create', compact('statusDDL', 'typeDDL'));
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
                'store_id' => Auth::user()->store->id,
                'name' => $data['name'],
                'code' => $data['code'],
                'status' => $data['status'],
                'is_default' => $data['is_default'] == 'on' ? true:false,
            ]);

            return redirect(route('db.acc.cash'));
        }
    }

    public function edit($id)
    {
        $acccash = AccountingCash::find($id);

        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('description', 'code');
        $typeDDL = LookupRepo::findByCategory('ACCCASH')->pluck('i18nDescription', 'code');

        return view('accounting.cash.edit', compact('acccash', 'statusDDL', 'typeDDL'));
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
            $acc = AccountingCash::find($id);
            $acc->code = $req['code'];
            $acc->name = $req['name'];
            $acc->is_default = $req['is_default'] == 'on' ? true:false;
            $acc->status = $req['status'];

            $acc->save();

            return redirect(route('db.acc.cash'));
        }
    }

    public function delete($id)
    {
        AccountingCash::find($id)->delete();
        return redirect(route('db.acc.cash'));
    }
}
