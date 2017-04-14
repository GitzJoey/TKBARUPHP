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

    public function store(Request $request)
    {
        Log::info('[PurchaseOrderController@store]');

        $this->validate($request, [
            'code'                      => 'required|string|max:255',
            'po_type'                   => 'required|string|max:255',
            'po_created'                => 'required|string|max:255',
            'shipping_date'             => 'required|string|max:255',
            'supplier_type'             => 'required|string|max:255',
            'item_product_id'           => 'required',
            'item_selected_unit_id.*'   => 'required|numeric',
            'item_quantity.*'           => 'required|numeric',
            'item_price.*'              => 'required|numeric',
            'supplier_id'               => 'required_if:supplier_type,SUPPLIERTYPE.R|numeric',
            'walk_in_supplier'          => 'required_if:supplier_type,SUPPLIERTYPE.WI|string|max:255',
            'warehouse_id'              => 'required|numeric',
            'item_disc_percent.*.*'     => 'numeric',
            'item_disc_value.*.*'       => 'numeric',
            'disc_total_percent'        => 'numeric',
            'disc_total_value'          => 'numeric',
        ]);
        $this->purchaseOrderService->createPO($request);

        if (!empty($request->input('submitcreate'))) {
            return redirect()->action('PurchaseOrderController@create');
        } else {
            return redirect(route('db'));
        }

    }
}
