<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 10/27/2016
 * Time: 10:12 AM
 */

namespace App\Http\Controllers;

use App\Model\Truck;
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
        Log::info("[WarehouseInflowController@inflow]");

        $warehouseDDL = Warehouse::all();

        return view('warehouse.inflow', compact('warehouseDDL'));
    }

    public function receipt($id)
    {
        Log::info("[WarehouseInflowController@receipt]");

        $po = $this->purchaseOrderService->getPOForReceipt($id);
        $truck = Truck::get()->pluck('plate_number', 'plate_number');

        return view('warehouse.receipt', compact('po', 'truck'));
    }

    public function saveReceipt(Request $request, $id)
    {
        Log::info("[WarehouseInflowController@saveReceipt]");

        $this->inflowService->createPOReceipt($request, $id);

        return response()->json();
    }

    public function getWarehousePOs($id)
    {
        Log::info("[WarehouseInflowController@getWarehousePOs]");

        $POs = $this->purchaseOrderService->getWarehousePO($id);

        Log::info("[WarehouseInflowController@getWarehousePOs]".$POs);

        return $POs;
    }
}