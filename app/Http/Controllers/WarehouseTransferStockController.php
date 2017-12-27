<?php

namespace App\Http\Controllers;

use App\Model\Unit;
use App\Model\StockTransfer;
use App\Model\Warehouse;
use App\Model\WarehouseSection;

use App\Services\StockTransferService;

use Auth;
use Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class WarehouseTransferStockController extends Controller
{
    private $stockTransferService;

    public function __construct(StockTransferService $stockTransferService)
    {
        $this->stockTransferService = $stockTransferService;
        $this->middleware('auth');
    }

    public function show($id)
    {
        Log::info('[WarehouseTransferStockController@show]');

        $stock_transfer = StockTransfer::find($id);

        return view('warehouse.transferstock.show', compact('stock_transfer'));
    }

    public function index()
    {
        Log::info('[WarehouseTransferStockController@stocktransfer]');

        $stock_transfer = StockTransfer::paginate(Config::get('const.PAGINATION'));

        return view('warehouse.transferstock.index', compact('stock_transfer'));
    }

    public function transfer()
    {
        Log::info('[WarehouseTransferStockController@transfer]');

        $warehouseDDL = Warehouse::where('status', '=', 'STATUS.ACTIVE')->get(['id', 'name']);

        return view('warehouse.transferstock.create', compact('warehouseDDL'));
    }

    public function saveTransfer(Request $request)
    {
        Log::info('[WarehouseTransferStockController@saveTransfer]');

        $this->stockTransferService->transfer($request);

        return response()->json();
    }

}
