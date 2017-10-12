<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Store;
use App\Model\TaxInput;
use App\Services\TaxInvoiceInputService;
use Illuminate\Http\Request;
// use App\Repos\LookupRepo;
use Illuminate\Support\Facades\Log;

class TaxInvoiceInputController extends Controller
{
    public $taxInvoiceInputService;

    public function __construct(TaxInvoiceInputService $taxInvoiceInputService)
    {
        $this->taxInvoiceInputService = $taxInvoiceInputService;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Log::info('[TaxInvoiceInputController@index] ');
        $taxes = TaxInput::orderBy('invoice_date', 'desc')->get();
        return view('tax.invoice.input.index', compact('taxes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Log::info('[TaxInvoiceInputController@create] ');
        $currentStore = Store::find(Auth::user()->store_id);
        return view('tax.invoice.input.create', compact('currentStore'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('[TaxInvoiceInputController@store]');

        try {
            $this->taxInvoiceInputService->createInvoice($request);
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 500);
            }
            return back();
        }

        return response()->json();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Log::info('[TaxInvoiceInputController@show] $id: ' . $id);
        $currentStore = new Store();
        $currentStore = $currentStore->find(Auth::user()->store_id);
        $tax = $this->taxInvoiceInputService->getTaxByID($id);

        return view('tax.invoice.input.show', compact('tax', 'currentStore'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Log::info('[TaxInvoiceInputController@show] $id: ' . $id);
        $currentStore = new Store();
        $currentStore = $currentStore->find(Auth::user()->store_id);
        $tax = $this->taxInvoiceInputService->getTaxByID($id);

        return view('tax.invoice.input.edit', compact('tax', 'currentStore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::info('[TaxInvoiceInputController@update]');

        try {
            $this->taxInvoiceInputService->editInvoice($request, $id);
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => $e->getMessage()
                ], 500);
            }
            return back();
        }

        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Log::info('[TaxInvoiceInputController@destroy] $id:' . $id);

        $tax = TaxInput::find($id);
        $tax->delete();

        return redirect(route('db.tax.invoice.input.index'));
    }
}
