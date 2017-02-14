<?php

namespace App\Http\Controllers\Accounting;

use App\Model\Accounting\Cost;
use App\Model\Accounting\CashAccount;
use App\Model\Accounting\CostCategory;

use Auth;
use Validator;
use Illuminate\Http\Request;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Controllers\Controller;

class CostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $costlist = Cost::paginate(10);
        return view('accounting.cost.index', compact('costlist'));
    }

    public function create()
    {
        $accountDDL = CashAccount::get()->pluck('codeAndName', 'id');
        $costGroup = CostCategory::get()->pluck('groupAndName', 'id');

        return view('accounting.cost.create', compact('accountDDL', 'costGroup'));
    }

    public function store()
    {
        return redirect(route('db.acc.cost'));
    }

    public function edit()
    {
        return view('accounting.cost.edit');
    }

    public function update()
    {
        return redirect(route('db.acc.cost'));
    }

    public function categoryIndex()
    {
        $costcat = CostCategory::paginate(10);

        return view('accounting.cost.category.index', compact('costcat'));
    }

    public function categoryShow($id)
    {
        $cc = CostCategory::find($id);

        return view('accounting.cost.category.show', compact('cc'));
    }

    public function categoryCreate()
    {
        $groupdistinct = CostCategory::select('group')->groupBy('group')->get();

        return view('accounting.cost.category.create', compact('groupdistinct'));
    }

    public function categoryStore(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.acc.cost.category.create'))->withInput()->withErrors($validator);
        } else {
            CostCategory::create([
                'store_id' => Auth::user()->store->id,
                'name' => $data['name'],
                'group' => empty($data['group_select']) ? $data['group_text']:'',
            ]);

            return redirect(route('db.acc.cost.category'));
        }
    }

    public function categoryEdit($id)
    {
        $cc = CostCategory::find($id);
        $groupdistinct = AccountingCostCategory::select(['group', 'group'])->groupBy('group')->get();

        return view('accounting.cost.category.edit', compact('cc', 'groupdistinct'));
    }

    public function categoryUpdate($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.acc.cost.category.edit', Hashids::encode($id)))->withInput()->withErrors($validator);
        } else {
            $acc = CostCategory::find($id);
            $acc->group = empty($data['group_select']) ? $data['group_text']:'';
            $acc->name = $data['name'];

            $acc->save();

            return redirect(route('db.acc.cost.category'));
        }
    }

    public function categoryDelete($id)
    {
        CostCategory::find($id)->delete();
        return redirect(route('db.acc.cost.category'));
    }
}
