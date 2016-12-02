<?php

namespace App\Http\Controllers;

use App\Model\ExpenseTemplate;
use App\Model\Lookup;
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
        $expenseTemplates = ExpenseTemplate::paginate(10);

        return view('expense_template.index', compact('expenseTemplates'));
    }

    public function create()
    {
        $expenseTypes = Lookup::where('category', '=', 'EXPENSETYPE')->get()->pluck('description', 'code');

        return view('expense_template.create', compact('expenseTypes'));
    }

    public function store(Request $request)
    {
        Log::info($request);

        ExpenseTemplate::create([
            'name' => $request->input('name'),
            'type' => $request->input('type'),
            'amount' => floatval(str_replace(',', '', $request->input('amount'))),
            'remarks' => $request->input('remarks'),
            'is_internal_expense' => $request->has('is_internal_expense') ? true : false
        ]);

        return redirect(route('db.master.expense_template'));
    }

    public function show($id)
    {
        $expenseTemplate = ExpenseTemplate::find($id);

        return view('expense_template.show')->with('expenseTemplate', $expenseTemplate);
    }

    public function edit($id)
    {
        $expenseTemplate = ExpenseTemplate::find($id);

        $expenseTypes = Lookup::where('category', '=', 'EXPENSETYPE')->get()->pluck('description', 'code');

        return view('expense_template.edit', compact('expenseTemplate', 'expenseTypes'));
    }

    public function update($id, Request $request)
    {
        $expenseTemplate = ExpenseTemplate::find($id);

        $expenseTemplate->name = $request->input('name');
        $expenseTemplate->type = $request->input('type');
        $expenseTemplate->amount = floatval(str_replace(',', '', $request->input('amount')));
        $expenseTemplate->remarks = $request->input('remarks');
        $expenseTemplate->is_internal_expense = $request->has('is_internal_expense') ? true : false;

        $expenseTemplate->save();

        return redirect(route('db.master.expense_template'));
    }

    public function delete($id)
    {
        ExpenseTemplate::find($id)->delete();

        return redirect(route('db.master.expense_template'));
    }
}
