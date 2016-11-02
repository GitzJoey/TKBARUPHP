<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 10/27/2016
 * Time: 10:13 AM
 */

namespace App\Http\Controllers;

use App\Model\Deliver;
use App\Model\ProductUnit;
use App\Model\Stock;
use App\Model\StockOut;
use App\Model\Warehouse;
use App\Model\SalesOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WarehouseOutflowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [ 'except' => [ 'getWarehouseSOs' ] ]);
    }

    public function outflow()
    {
        $warehouseDDL = Warehouse::all(['id', 'name']);

        return view('warehouse.outflow', compact('warehouseDDL'));
    }

    public function deliver($id)
    {
        $so = SalesOrder::with('items.product.productUnits.unit')->find($id);

        return view('warehouse.deliver', compact('so'));
    }

    public function saveDeliver(Request $request, $id)
    {
        for ($i = 0; $i < sizeof($request->input('item_id')); $i++) {
            $conversionValue = ProductUnit::where([
                'product_id' => $request->input("product_id.$i"),
                'unit_id' => $request->input("selected_unit_id.$i")
            ])->first()->conversion_value;

            $deliverParams = [
                'deliver_date' => date('Y-m-d', strtotime($request->input('deliver_date'))),
                'conversion_value' => $conversionValue,
                'brutto' => $request->input("brutto.$i"),
                'base_brutto' => $conversionValue * $request->input("brutto.$i"),
                'netto' => $request->input("brutto.$i"),
                'base_netto' => $conversionValue * $request->input("brutto.$i"),
                'tare' => 0,
                'base_tare' => 0,
                'licence_plate' => $request->input('licence_plate'),
                'item_id' => $request->input("item_id.$i"),
                'selected_unit_id' => $request->input("selected_unit_id.$i"),
                'base_unit_id' => $request->input("base_unit_id.$i"),
                'store_id' => Auth::user()->store_id
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

        return redirect(route('db.warehouse.outflow.index'));
    }

    public function getWarehouseSOs(Request $request, $id)
    {
        Log::info("WarehouseOutflowController@getWarehouseSOs");

        $SOs = SalesOrder::with('customer')->where('warehouse_id', '=', $id)->get();

        Log::info($SOs);

        return $SOs;
    }
}