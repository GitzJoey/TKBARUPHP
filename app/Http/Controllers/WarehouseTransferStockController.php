<?php

namespace App\Http\Controllers;

use App\Model\Unit;
use App\Model\StockTransfer;
use App\Model\Warehouse;
use App\Model\WarehouseSection;

use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class WarehouseTransferStockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        Log::info('[WarehouseController@stocktransfer]');
        $stock_transfer = StockTransfer::paginate(10);

        return view('warehouse.transferstock.index', compact('stock_transfer'));
    }

    public function transfer()
    {
        $warehouseDDL = Warehouse::where('status', '=', 'STATUS.ACTIVE')->get(['id', 'name']);

        return view('warehouse.transferstock.create', compact('warehouseDDL'));
    }

}
