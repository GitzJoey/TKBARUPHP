<?php

namespace App\Http\Controllers\Accounting;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Model\Accounting\CashAccount;

use App\Repos\LookupRepo;

class CashAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $acccash = CashAccount::paginate(10);

        $typeDDL = LookupRepo::findByCategory('ACCCASH')->pluck('i18nDescription', 'code');

        return view('accounting.cash.index', compact('acccash', 'typeDDL'));
    }

    public function show($id)
    {
        $acccash = CashAccount::find($id);

        return view('accounting.cash.show', compact('acccash'));
    }

    public function create()
    {
        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $typeDDL = LookupRepo::findByCategory('ACCCASH')->pluck('i18nDescription', 'code');

        return view('accounting.cash.create', compact('statusDDL', 'typeDDL'));
    }

    public function store(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ])->validate();

        CashAccount::create([
            'store_id' => Auth::user()->store->id,
            'type' => $data['type'],
            'name' => $data['name'],
            'code' => $data['code'],
            'status' => $data['status'],
            'is_default' => $data['is_default'] == 'on' ? true:false,
        ]);

        return response()->json();
    }

    public function edit($id)
    {
        $acccash = CashAccount::find($id);

        $statusDDL = LookupRepo::findByCategory('STATUS')->pluck('i18nDescription', 'code');
        $typeDDL = LookupRepo::findByCategory('ACCCASH')->pluck('i18nDescription', 'code');

        return view('accounting.cash.edit', compact('acccash', 'statusDDL', 'typeDDL'));
    }

    public function update($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ])->validate();

        $acc = CashAccount::find($id);
        $acc->type = $req['type'];
        $acc->code = $req['code'];
        $acc->name = $req['name'];
        $acc->is_default = $req['is_default'] == 'on' ? true:false;
        $acc->status = $req['status'];

        $acc->save();

        return response()->json();
    }

    public function delete($id)
    {
        CashAccount::find($id)->delete();
        return redirect(route('db.acc.cash'));
    }
}
