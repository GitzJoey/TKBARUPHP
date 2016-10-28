<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 10/27/2016
 * Time: 10:12 AM
 */

namespace App\Http\Controllers;

use App\Model\Receipt;
use App\Model\Warehouse;
use App\Model\PurchaseOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WarehouseInflowController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inflow(){
        $warehouseDDL = Warehouse::all([ 'id', 'name' ]);
        $allPOs = PurchaseOrder::with('supplier')->where('status', '=', 'POSTATUS.WA')->get();

        return view('warehouse.inflow', compact('warehouseDDL', 'allPOs'));
    }

    public function receipt($id){
        $po = PurchaseOrder::with('items.product.productUnits.unit')->find($id);

        return view('warehouse.receipt', compact('po'));
    }

    public function saveReceipt(Request $request){
        for($i = 0; $i < sizeof($request->input('item_id')); $i++){
            $params = [
                'receipt_date' => date('Y-m-d', strtotime($request->input('receipt_date'))),
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

        return redirect(route('db.warehouse.inflow.index'));
    }
}