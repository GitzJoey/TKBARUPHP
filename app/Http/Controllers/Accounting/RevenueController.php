<?php

namespace App\Http\Controllers\Accounting;

use App\Model\Accounting\Revenue;
use App\Model\Accounting\RevenueCategory;

use Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RevenueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $revlist = Revenue::paginate(10);
        return view('accounting.revenue.index', compact('revlist'));
    }

    public function create()
    {
        return view('accounting.revenue.create');
    }

    public function store()
    {
        return redirect(route('db.revenue.index'));
    }

    public function edit()
    {
        return view('accounting.revenue.edit');
    }

    public function update()
    {
        return redirect(route('db.revenue.index'));
    }

    public function categoryIndex()
    {
        $revcat = RevenueCategory::paginate(10);

        return view('accounting.revenue.category.index', compact('revcat'));
    }

    public function categoryShow($id)
    {
        $rc = RevenueCategory::find($id);

        return view('accounting.revenue.category.show', compact('rc'));
    }

    public function categoryCreate()
    {
        $groupdistinct = RevenueCategory::select(['group', 'group'])->groupBy('group')->get();

        return view('accounting.revenue.category.create', compact('groupdistinct'));
    }

    public function categoryStore(Request $data)
    {
        $validator = Validator::make($data->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.acc.revenue.category.create'))->withInput()->withErrors($validator);
        } else {
            RevenueCategory::create([
                'store_id' => Auth::user()->store->id,
                'name' => $data['name'],
                'group' => empty($data['group_select']) ? $data['group_text']:'',
            ]);

            return redirect(route('db.acc.revenue.category'));
        }
    }

    public function categoryEdit($id)
    {
        $rc = RevenueCategory::find($id);
        $groupdistinct = RevenueCategory::select(['group', 'group'])->groupBy('group')->get();

        return view('accounting.revenue.category.edit', compact('rc', 'groupdistinct'));
    }

    public function categoryUpdate($id, Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect(route('db.acc.revenue.category.edit', Hashids::encode($id)))->withInput()->withErrors($validator);
        } else {
            $ac = RevenueCategory::find($id);
            $ac->group = empty($data['group_select']) ? $data['group_text']:'';
            $ac->name = $data['name'];

            $ac->save();

            return redirect(route('db.acc.revenue.category'));
        }
    }

    public function categoryDelete($id)
    {
        RevenueCategory::find($id)->delete();
        return redirect(route('db.acc.revenue.category'));
    }
}