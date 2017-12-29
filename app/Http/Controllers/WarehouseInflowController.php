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

use App\Repos\LookupRepo;
use App\Services\InflowService;
use App\Services\SalesOrderService;
use App\Services\PurchaseOrderService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WarehouseInflowController extends Controller
{
    private $inflowService;
    private $purchaseOrderService;
    private $salesOrderService;

    public function __construct(
        InflowService $inflowService, PurchaseOrderService $purchaseOrderService, SalesOrderService $salesOrderService)
    {
        $this->inflowService = $inflowService;
        $this->purchaseOrderService = $purchaseOrderService;
        $this->salesOrderService = $salesOrderService;

        $this->middleware('auth', [ 'except' => [
            'getWarehousePOs',
            'getWarehousePOByCode',
            'getWarehouseSOByCode',
        ] ]);
    }

    public function inflow()
    {
        Log::info("[WarehouseInflowController@inflow] ");

        $warehouseDDL = Warehouse::all();

        return view('warehouse.inflow', compact('warehouseDDL'));
    }

    public function receipt($id)
    {
        Log::info("[WarehouseInflowController@receipt] ");

        $po = $this->purchaseOrderService->getPOForReceipt($id);
        $truck = Truck::get()->pluck('plate_number', 'plate_number');
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE');

        return view('warehouse.receipt', compact('po', 'truck', 'expenseTypes'));
    }

    public function saveReceipt(Request $request, $id)
    {
        Log::info("[WarehouseInflowController@saveReceipt] ");

        $po = $this->purchaseOrderService->getPOForReceipt($id);

        if ($po->status == config('lookups.PO_STATUS.WAITING_ARRIVAL')) {
            $this->inflowService->createPOReceipt($request, $id);
        }

        $expenseArr = array();
        for($i = 0; $i < count($request->input('expense_id')); $i++){
            if ($request->input('expense_id'.$i) != 0) continue;

            array_push($expenseArr, array (
                'expense_name' => $request->input("expense_name.$i"),
                'expense_type' => $request->input("expense_type.$i"),
                'is_internal_expense' => true,
                'expense_amount' => floatval(str_replace(',', '', $request->input("expense_amount.$i"))),
                'expense_remarks' => $request->input("expense_remarks.$i")
            ));
        }

        $this->purchaseOrderService->addExpenses($id, $expenseArr);

        return response()->json();
    }

    public function getWarehousePOs($id)
    {
        Log::info("[WarehouseInflowController@getWarehousePOs] ");

        $POs = $this->purchaseOrderService->getWarehousePO($id);

        Log::info("[WarehouseInflowController@getWarehousePOs]".$POs);

        return $POs;
    }

    public function getWarehousePOByCode($code)
    {
        Log::info("[WarehouseInflowController@getWarehousePOByCode] ");

        $PO = $this->purchaseOrderService->getPOByCode($code);

        Log::info("[WarehouseInflowController@getWarehousePOByCode] ".$PO);

        return $PO;
    }

    public function getWarehouseSOByCode($code)
    {
        Log::info("[WarehouseInflowController@getWarehouseSOByCode] ");

        $SO = $this->salesOrderService->getSOByCode($code);

        Log::info("[WarehouseInflowController@getWarehouseSOByCode] ".$SO);

        return $SO;
    }
}