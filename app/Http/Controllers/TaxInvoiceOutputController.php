<?php

namespace App\Http\Controllers;

use Auth;
use App\Model\Store;
use App\Model\Tax;
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
        $taxes = new Tax();
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
            return response()->json([
                'result' => 'failed',
                'message' => ''
            ]);
        };

        return response()->json([
            'result' => 'success',
            'message' => '',
        ]);
    }

    public function show($id)
    {
        Log::info('[TaxInvoiceOutputController@show] $id: ' . $id);

        $store = Tax::find($id);

        return view('tax.invoice.output.show')->with('store', $store);
    }

    public function revise($id)
    {
        Log::info('[TaxInvoiceOutputController@revise]');

        $tax = $this->taxInvoiceOutputService->editTax($id);

        return view('tax.invoice.output.revise', compact('tax'));
    }
}
