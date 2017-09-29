<?php

namespace App\Http\Controllers;

use App\Model\Stock;
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
                'getCurrentStocks'
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
}
