<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 10/27/2016
 * Time: 10:13 AM
 */

namespace App\Http\Controllers;

use App\Model\Warehouse;
use App\Model\SalesOrder;

class WarehouseOutflowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function outflow()
    {
        $warehouseDDL = Warehouse::all(['id', 'name']);
        $allSOs = SalesOrder::with('customer')->where('status', '=', 'POSTATUS.WA')->get();

        return view('warehouse.outflow', compact('warehouseDDL', 'allSOs'));
    }

    public function deliver($id)
    {
        $po = SalesOrder::with('items.product.productUnits.unit')->find($id);

        return view('warehouse.receipt', compact('po'));
    }

    public function saveDeliver(Request $request)
    {
        for ($i = 0; $i < sizeof($request->input('item_id')); $i++) {
            $params = [
                'deliver_date' => date('Y-m-d', strtotime($request->input('deliver_date'))),
                'brutto' => $request->input("brutto.$i"),
                'netto' => $request->input("netto.$i"),
                'tare' => $request->input("tare.$i"),
                'licence_plate' => $request->input('licence_plate'),
                'item_id' => $request->input("item_id.$i"),
                'selected_unit_id' => $request->input("selected_unit_id.$i"),
                'store_id' => Auth::user()->store_id
            ];

            $receipt = Receipt::create($params);
        }

        return redirect(route('db.warehouse.outflow.index'));
    }
}