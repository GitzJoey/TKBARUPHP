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

        if (is_null($this->taxInvoiceInputService->createInvoice($request))) {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
