<?php

namespace App\Http\Controllers;

use App\Model\Stock;
use App\Model\ProductType;

use App\Services\StockService;

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
                'stockTypeIndex'
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

    public function stockTypeIndex(Request $request){

        /* search */
        $type_ids = !empty($type_ids)? $type_ids : null;
        $to_json = trim($request->get('to_json'));
        $to_json = !empty($to_json)? true : false;

        $prodtypeDdL = ProductType::with('stocks.soItems.itemable.customer', 'stocks.soItems.selectedUnit.unit', 'stocks.product', 'stocks.purchaseOrder');
        if (!is_null($type_ids)){
            $prodtypeDdL = $prodtypeDdL->whereIn('id', $type_ids);
        }
        return response()->json($prodtypeDdL->get());
    }

    public function mergerIndex(Request $request)
    {
        $stockmerge = Stock::paginate(10);

        return view('warehouse.stockmerger.index')->with('stockmerge', $stockmerge);
    }

    public function mergerCreate(Request $request)
    {

        return view('warehouse.stockmerger.create');
    }
}
