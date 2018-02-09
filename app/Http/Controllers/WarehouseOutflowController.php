<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 10/27/2016
 * Time: 10:13 AM
 */

namespace App\Http\Controllers;

use App\Model\Expense;
use App\Model\Stock;
use App\Model\Truck;
use App\Model\Deliver;
use App\Model\StockOut;
use App\Model\Warehouse;
use App\Model\SalesOrder;
use App\Model\ProductUnit;

use App\Repos\LookupRepo;

use App\Services\SalesOrderService;

use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class WarehouseOutflowController extends Controller
{
    private $salesOrderService;

    public function __construct(SalesOrderService $salesOrderService)
    {
        $this->middleware('auth', [ 'except' => [ 'getWarehouseSOs' ] ]);
        $this->salesOrderService = $salesOrderService;
    }

    public function outflow()
    {
        Log::info("[WarehouseOutflowController@outflow]");

        $warehouseDDL = Warehouse::all()->toJson();

        return view('warehouse.outflow', compact('warehouseDDL'));
    }

    public function getWarehouseSOs(Request $request, $id)
    {
        Log::info("[WarehouseOutflowController@getWarehouseSOs]");

        $SOs = SalesOrder::with('customer')->where('status', '=', 'SOSTATUS.WD')->where('warehouse_id', '=', $id)->get();

        Log::info($SOs);

        return $SOs;
    }

    public function deliver($id)
    {
        Log::info("[WarehouseOutflowController@deliver]");

        $so = SalesOrder::with('items.product.productUnits.unit')->find($id);
        $truck = Truck::get()->pluck('plate_number', 'plate_number');
        $expenseTypes = LookupRepo::findByCategory('EXPENSETYPE');

        return view('warehouse.deliver', compact('so', 'truck', 'expenseTypes'));
    }

    public function saveDeliver(Request $request, $id)
    {
        Log::info("[WarehouseOutflowController@saveDeliver]");

        DB::beginTransaction();

        try {
            for ($i = 0; $i < sizeof($request->input('item_id')); $i++) {
                $conversionValue = ProductUnit::whereId($request->input("selected_unit_id.$i"))->first()->conversion_value;

                $deliverParams = [
                    'deliver_date' => date('Y-m-d', strtotime($request->input('deliver_date'))),
                    'conversion_value' => $conversionValue,
                    'brutto' => $request->input("brutto.$i"),
                    'base_brutto' => $conversionValue * $request->input("brutto.$i"),
                    'netto' => 0,
                    'base_netto' => 0,
                    'tare' => 0,
                    'base_tare' => 0,
                    'license_plate' => $request->input('license_plate'),
                    'item_id' => $request->input("item_id.$i"),
                    'selected_unit_id' => $request->input("selected_unit_id.$i"),
                    'base_unit_id' => $request->input("base_unit_id.$i"),
                    'store_id' => Auth::user()->store_id,
                    'status' => 'CUSTCONFSTATUS.WSC'
                ];

                $deliver = Deliver::create($deliverParams);

                if($request->input("stock_id.$i") != 0){
                    $stockOutParams = [
                        'store_id' => Auth::user()->store_id,
                        'so_id' => $id,
                        'product_id' => $request->input("product_id.$i"),
                        'warehouse_id' => $request->input('warehouse_id'),
                        'stock_id' => $request->input("stock_id.$i"),
                        'quantity' => $request->input("brutto.$i")
                    ];

                    $stockOut = StockOut::create($stockOutParams);

                    $stock = Stock::find($request->input("stock_id.$i"));
                    $stock->current_quantity -= $request->input("brutto.$i");
                    $stock->save();
                }
            }

            $expenseArr = array();
            for ($x = 0; $x < sizeof($request->input('so_0_expense_name')); $x++) {
                array_push($expenseArr, array (
                    'expense_name' => $request->input("so_0_expense_name")[$x],
                    'expense_type' => $request->input("so_0_expense_type")[$x],
                    'is_internal_expense' => true,
                    'expense_amount' => floatval(str_replace(',', '', $request->input("so_0_expense_amount")[$x])),
                    'expense_remarks' => $request->input("so_0_expense_remarks")[$x]
                ));
            }

            $this->salesOrderService->addExpense($id, $expenseArr);

            $so = SalesOrder::whereId($id)->first();
            $so->status = 'SOSTATUS.WCC';
            $so->save();

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }

        return response()->json();
    }
}