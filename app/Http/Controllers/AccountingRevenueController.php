<?php

namespace App\Http\Controllers;

use App\Model\AccountingRevenueCategory;

use Auth;
use Validator;
use Illuminate\Http\Request;

class AccountingRevenueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('accounting.revenue_index');
    }

    public function categoryIndex()
    {
        $revcat = AccountingRevenueCategory::paginate(10);

        return view('accounting.revenue.category.index', compact('revcat'));
    }

    public function categoryShow($id)
    {
        $rc = AccountingRevenueCategory::find($id);

        return view('accounting.revenue.category.show', compact('rc'));
    }

    public function categoryCreate()
    {
        return view('accounting.revenue.category.create', compact('groupdistinct'));
    }

    public function categoryStore(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
            'group' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.acc.revenue.category.create'))->withInput()->withErrors($validator);
        } else {
            AccountingRevenueCategory::create([
                'store_id' => Auth::user()->store->id,
                'name' => $data['name'],
                'group' => $data['group'],
            ]);

            return redirect(route('db.acc.revenue.category'));
        }
    }

    public function categoryEdit($id)
    {
        $rc = AccountingRevenueCategory::find($id);

        return view('accounting.revenue.category.edit', compact('rc'));
    }

    public function categoryUpdate($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|max:255',
            'group' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.acc.revenue.category.edit', Hashids::encode($id)))->withInput()->withErrors($validator);
        } else {
            AccountingRevenueCategory::find($id)->update($req->all());
            return redirect(route('db.acc.revenue.category'));
        }
    }

    public function categoryDelete($id)
    {
        AccountingRevenueCategory::find($id)->delete();
        return redirect(route('db.acc.revenue.category'));
    }
}
