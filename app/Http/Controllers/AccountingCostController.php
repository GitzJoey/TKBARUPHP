<?php

namespace App\Http\Controllers;

use App\Model\AccountingCostCategory;

use Auth;
use Validator;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;

class AccountingCostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $costlist = Accountingcost;
        return view('accounting.cost.index', compact('costlist'));
    }

    public function categoryIndex()
    {
        $costcat = AccountingCostCategory::paginate(10);

        return view('accounting.cost.category.index', compact('costcat'));
    }

    public function categoryShow($id)
    {
        $cc = AccountingCostCategory::find($id);

        return view('accounting.cost.category.show', compact('cc'));
    }

    public function categoryCreate()
    {
        return view('accounting.cost.category.create', compact('groupdistinct'));
    }

    public function categoryStore(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'group' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.acc.cost.category.create'))->withInput()->withErrors($validator);
        } else {
            AccountingCostCategory::create([
                'store_id' => Auth::user()->store->id,
                'name' => $data['name'],
                'group' => $data['group'],
            ]);

            return redirect(route('db.acc.cost.category'));
        }
    }

    public function categoryEdit($id)
    {
        $cc = AccountingCostCategory::find($id);

        return view('accounting.cost.category.edit', compact('cc'));
    }

    public function categoryUpdate($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|max:255',
            'group' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.acc.cost.category.edit', Hashids::encode($id)))->withInput()->withErrors($validator);
        } else {
            AccountingCostCategory::find($id)->update($req->all());
            return redirect(route('db.acc.cost.category'));
        }
    }

    public function categoryDelete($id)
    {
        AccountingCostCategory::find($id)->delete();
        return redirect(route('db.acc.cost.category'));
    }
}
