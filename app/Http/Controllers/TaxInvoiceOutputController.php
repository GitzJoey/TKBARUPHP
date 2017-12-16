<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Store;
use App\Model\TaxOutput;
use App\Services\TaxInvoiceOutputService;
use Illuminate\Http\Request;
use App\Repos\LookupRepo;
use Illuminate\Support\Facades\Log;

class TaxInvoiceOutputController extends Controller
{
    public $taxInvoiceOutputService;

    public function __construct(TaxInvoiceOutputService $taxInvoiceOutputService)
    {
        $this->taxInvoiceOutputService = $taxInvoiceOutputService;
        $this->middleware('auth');
    }

    public function index()
    {
        Log::info('[TaxInvoiceOutputController@index] ');
        $taxes = new TaxOutput();
        $taxes = $taxes->orderBy('invoice_date', 'desc')->get();
        return view('tax.invoice.output.index', compact('taxes'));
    }

    public function create() {
        Log::info('[TaxInvoiceOutputController@create] ');
        $currentStore = new Store();
        $currentStore = $currentStore->find(Auth::user()->store_id);
        $gstTranTypeDDL = LookupRepo::findByCategory('GSTTRANSACTIONTYPEOUTPUT');
        $tranDocDDL = LookupRepo::findByCategory('TRANSACTIONDOCOUTPUT');
        $tranDetailDDL = LookupRepo::findByCategory('TRANSACTIONDETAILOUTPUT');
        return view('tax.invoice.output.create', compact('gstTranTypeDDL', 'tranDocDDL', 'tranDetailDDL', 'currentStore'));
    }

    public function store(Request $request){
        Log::info('[TaxInvoiceOutput@store]');

        if (is_null($this->taxInvoiceOutputService->createInvoice($request))) {
            return response()->json(['errors' => 'Failed to create Invoice'], 500);
        };

        return response()->json();
    }

    public function show($id)
    {
        Log::info('[TaxInvoiceOutputController@show] $id: ' . $id);
        $currentStore = new Store();
        $currentStore = $currentStore->find(Auth::user()->store_id);
        $tax = $this->taxInvoiceOutputService->getTaxByID($id);

        $gstTranTypeDDL = LookupRepo::findByCategory('GSTTRANSACTIONTYPEOUTPUT');
        $tranDocDDL = LookupRepo::findByCategory('TRANSACTIONDOCOUTPUT');
        $tranDetailDDL = LookupRepo::findByCategory('TRANSACTIONDETAILOUTPUT');

        return view('tax.invoice.output.show', compact('tax', 'currentStore', 'gstTranTypeDDL', 'tranDocDDL', 'tranDetailDDL'));
    }

    public function edit($id)
    {
        Log::info('[TaxInvoiceOutputController@revise]');
        $currentStore = new Store();
        $currentStore = $currentStore->find(Auth::user()->store_id);
        $tax = $this->taxInvoiceOutputService->getTaxByID($id);

        $gstTranTypeDDL = LookupRepo::findByCategory('GSTTRANSACTIONTYPEOUTPUT');
        $tranDocDDL = LookupRepo::findByCategory('TRANSACTIONDOCOUTPUT');
        $tranDetailDDL = LookupRepo::findByCategory('TRANSACTIONDETAILOUTPUT');

        return view('tax.invoice.output.edit', compact('tax', 'currentStore', 'gstTranTypeDDL', 'tranDocDDL', 'tranDetailDDL'));
    }

    public function saveEdit(Request $request, $id)
    {
        $this->taxInvoiceOutputService->editInvoice($request, $id);

        return response()->json();
    }

    public function delete($id)
    {
        Log::info('[TaxInvoiceOutputController@delete] $id:' . $id);

        $tax = TaxOutput::find($id);
        $tax->transactions->each(function($ba) { $ba->delete(); });
        $tax->delete();

        return redirect(route('db.tax.invoice.output.index'));
    }
}
