<?php

namespace App\Http\Controllers;

use App\Model\ExpenseTemplate;

use App\Repos\LookupRepo;

use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExpenseTemplateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $expenseTemplates = ExpenseTemplate::paginate(Config::get('const.PAGINATION'));

        return view('expense_template.index', compact('expenseTemplates'));
    }

    public function create()
    {
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE')->pluck('i18nDescription', 'code');

        return view('expense_template.create', compact('expenseTypes'));
    }

    public function store(Request $request)
    {
        Log::info($request);

        $validator = $this->validate($request, [
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'amount' => 'required|max:255',
            'remarks' => 'required',
        ]);

        ExpenseTemplate::create([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'amount' => floatval(str_replace(',', '', $request->input('amount'))),
            'remarks' => $request->input('remarks'),
            'is_internal_expense' => $request->has('is_internal_expense') ? true : false
        ]);

        return response()->json();
    }

    public function show($id)
    {
        $expenseTemplate = ExpenseTemplate::find($id);

        return view('expense_template.show')->with('expenseTemplate', $expenseTemplate);
    }

    public function edit($id)
    {
        $expenseTemplate = ExpenseTemplate::find($id);

        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE')->pluck('i18nDescription', 'code');

        return view('expense_template.edit', compact('expenseTemplate', 'expenseTypes'));
    }

    public function update($id, Request $request)
    {
        $validator = $this->validate($request, [
            'name' => 'required|max:255',
            'type' => 'required|max:255',
            'amount' => 'required|max:255',
            'remarks' => 'required',
        ]);

        $expenseTemplate = ExpenseTemplate::find($id);

        $expenseTemplate->name = $request->input('name');
        $expenseTemplate->type = $request->input('type');
        $expenseTemplate->amount = floatval(str_replace(',', '', $request->input('amount')));
        $expenseTemplate->remarks = $request->input('remarks');
        $expenseTemplate->is_internal_expense = $request->has('is_internal_expense') ? true : false;

        $expenseTemplate->save();
        
        return response()->json();
    }

    public function delete($id)
    {
        ExpenseTemplate::find($id)->delete();

        return redirect(route('db.master.expense_template'));
    }
}
