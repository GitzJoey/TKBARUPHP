<?php

namespace App\Http\Controllers;

use App\Model\Stock;
use App\Model\ProductType;

use App\Model\StockMerge;
use App\Model\Warehouse;
use App\Services\StockService;

use App\Repos\LookupRepo;

use Illuminate\Http\Request;

class StockController extends Controller
{
    private $stockService;

    public function __construct(StockService $stockService)
    {
        $this->stockService = $stockService;
        $this->middleware('auth', [
            'except' => [
                'getCurrentStocks',
                'stockTypeIndex',
                'getStocksByProduct',
            ]
        ]);
    }

    public function getCurrentStocks($warehouseId)
    {
        return $this->stockService->getCurrentStocks($warehouseId);
    }

    public function getStock(Request $request) {
        $this->validate($request, [
            'id' => 'required|exists:'. (new Stock)->getTable()
        ]);
        return response()->json(Stock::find($request->id));
    }

    public function stockTypeIndex(Request $request)
    {
        /* search */
        $type_ids = !empty($type_ids)? $type_ids : null;
        $to_json = trim($request->get('to_json'));
        $to_json = !empty($to_json)? true : false;

        $prodtypeDdL = ProductType::with([
            'stocks' => function($s) { $s->where('current_quantity', '>', 0); },
            'stocks.soItems.itemable.customer',
            'stocks.soItems.selectedUnit' => function($q) { $q->with('unit')->withTrashed(); },
            'stocks.product',
            'stocks.purchaseOrder'
        ]);
        if (!is_null($type_ids)){
            $prodtypeDdL = $prodtypeDdL->whereIn('id', $type_ids);
        }
        return response()->json($prodtypeDdL->get());
    }

    public function mergerIndex(Request $request)
    {
        $stockmerge = StockMerge::paginate(10);

        return view('warehouse.stockmerger.index', compact('stockmerge'));
    }

    public function mergerCreate(Request $request)
    {
        $stockMergeDDL = LookupRepo::findByCategory(config('const.LOOKUP_CATEGORY.STOCK_MERGE_TYPE'))->pluck('i18nDescription', 'code');
        $stocks = $this->stockService->getStockWithSameProductId();
        $warehouseDDL = Warehouse::where('status', '=', 'STATUS.ACTIVE')->get(['id', 'name', 'address']);

        return view('warehouse.stockmerger.create', compact('stockMergeDDL','stocks', 'warehouseDDL'));
    }

    public function getStocksByProduct(Request $request)
    {
        return $this->stockService->getStockByProduct($request->query('pId'));
    }

    public function mergerShow($id)
    {
        $stockMergeDDL = LookupRepo::findByCategory(config('const.LOOKUP_CATEGORY.STOCK_MERGE_TYPE'))->pluck('i18nDescription', 'code');
        $stockMerge = StockMerge::with('stockMergeDetails')->whereId($id)->first();
        $warehouseDDL = Warehouse::where('status', '=', 'STATUS.ACTIVE')->get(['id', 'name', 'address']);

        return view('warehouse.stockmerger.show', compact('stockMerge', 'stockMergeDDL', 'warehouseDDL'));
    }

    public function mergeStock(Request $request)
    {
        $this->stockService->createMergeStock($request);

        return response()->json();
    }
}
