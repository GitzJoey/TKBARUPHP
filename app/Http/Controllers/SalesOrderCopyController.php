<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\SalesOrder;
use App\Model\SalesOrderCopy;

use App\Services\StockService;
use App\Services\SalesOrderService;
use App\Services\SalesOrderCopyService;

use App\Util\SOCopyCodeGenerator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SalesOrderCopyController extends Controller
{
    private $salesOrderCopyService;
    private $salesOrderService;
    private $stockService;

    public function __construct(SalesOrderCopyService $salesOrderCopyService,
                                SalesOrderService $salesOrderService,
                                StockService $stockService)
    {
        $this->salesOrderCopyService = $salesOrderCopyService;
        $this->salesOrderService = $salesOrderService;
        $this->stockService = $stockService;
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        Log::info('SalesOrderCopyController@search');
        $request->session()->forget(['code', 'error']);
        return view('sales_order.copy.search');
    }

    public function index(Request $request, $soCode = '')
    {
        Log::info('SalesOrderCopyController@index');
        $request->session()->forget(['code', 'error']);

        $so = SalesOrder::with('copies.customer')->whereCode(strtoupper($soCode))->first();

        Log::info($so);

        if (is_null($so)) {
            Log::info('SO not found');
            $request->session()->flash('code', $soCode);
            $request->session()->flash('error', 'so_not_found');
            return view('sales_order.copy.search');
        } else {
            Log::info('SO found');
            $soCopies = $so->copies;
            return view('sales_order.copy.index', compact('soCopies', 'soCode'));
        }
    }

    public function create(Request $request, $soCode)
    {
        Log::info('SalesOrderCopyController@create');

        $soToBeCopied = $this->salesOrderService->getSOForCopy($soCode);
        $soCopyCode = SOCopyCodeGenerator::generateCode($soCode);
        $productDDL = Product::with('productUnits.unit')->get();
        $stocksDDL = $this->stockService->getStocksForSO();

        return view('sales_order.copy.create', compact('soToBeCopied', 'soCopyCode', 'soCode', 'productDDL', 'stocksDDL'));
    }

    public function store(Request $request, $soCode)
    {
        Log::info('SalesOrderCopyController@store');

        $soCopy = $this->salesOrderCopyService->createSOCopy($request, $soCode);

        return response()->json();
    }

    public function edit($soCode, $id)
    {
        $currentSOCopy = $this->salesOrderCopyService->getSOCopyForEdit($id);
        $productDDL = Product::with('productUnits.unit')->get();

        return view('sales_order.copy.edit', compact('soCode', 'currentSOCopy', 'productDDL'));
    }

    public function update(Request $request, $soCode, $id)
    {
        $editedSOCopy = $this->salesOrderCopyService->editSOCopy($request, $id);

        return response()->json();
    }

    public function delete($soCode, $id)
    {
        $soCopy = SalesOrderCopy::find($id);
        $soCopy->items->each(function($i) { $i->delete(); });
        $soCopy->delete();

        return redirect(route('db.so.copy.index', $soCode));
    }
}
