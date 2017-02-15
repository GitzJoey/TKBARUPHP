<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 10/27/2016
 * Time: 10:12 AM
 */

namespace App\Http\Controllers;

use App\Model\Warehouse;

use App\Services\InflowService;
use App\Services\PurchaseOrderService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WarehouseInflowController extends Controller
{
    private $inflowService;
    private $purchaseOrderService;

    public function __construct(InflowService $inflowService, PurchaseOrderService $purchaseOrderService)
    {
        $this->inflowService = $inflowService;
        $this->purchaseOrderService = $purchaseOrderService;
        $this->middleware('auth', [ 'except' => [ 'getWarehousePOs' ] ]);
    }

    public function inflow()
    {
        $warehouseDDL = Warehouse::all();

        return view('warehouse.inflow', compact('warehouseDDL'));
    }

    public function receipt($id)
    {
        $po = $this->purchaseOrderService->getPOForReceipt($id);

        return view('warehouse.receipt', compact('po'));
    }

    public function saveReceipt(Request $request, $id)
    {
        $this->inflowService->createPOReceipt($request, $id);

        return redirect(route('db.warehouse.inflow.index', array('w' => $request->input('warehouse_id'))));
    }

    public function getWarehousePOs($id)
    {
        Log::info("WarehouseOutflowController@getWarehousePOs");

        $POs = $this->purchaseOrderService->getWarehousePO($id);

        Log::info($POs);

        return $POs;
    }
}