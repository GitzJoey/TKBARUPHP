<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 2:17 PM
 */

namespace App\Http\Controllers;

use Auth;
use App\Model\Items;
use App\Model\Lookup;
use App\Model\Product;
use App\Model\ProductUnit;
use App\Model\Supplier;
use App\Model\Warehouse;
use App\Model\PurchaseOrder;
use App\Model\VendorTrucking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Util\POCodeGenerator;
use Illuminate\Support\Facades\Log;

class PurchaseOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        Log::info('[PurchaseOrderController@create] ');

        $supplierDDL = Supplier::all([ 'id', 'name' ]);
        $warehouseDDL = Warehouse::all([ 'id', 'name' ]);
        $vendorTruckingDDL = VendorTrucking::all([ 'id', 'name' ]);
        $productDDL = Product::with('productUnits.unit')->get();
        $poTypeDDL = Lookup::where('category', '=', 'POTYPE')->get(['description', 'code']);
        $supplierTypeDDL = Lookup::where('category', '=', 'SUPPLIERTYPE')->get(['description', 'code']);
        $poCode = POCodeGenerator::generateWithLength(6);
        $poStatusDraft = Lookup::where('category', '=', 'POSTATUS')->get(['description', 'code'])->where('code', '=', 'POSTATUS.D');

        return view('purchase_order.create', compact(
            'supplierDDL',
            'warehouseDDL',
            'vendorTruckingDDL',
            'supplierTypeDDL',
            'poTypeDDL',
            'unitDDL',
            'productDDL',
            'poStatusDraft',
            'poCode'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[

        ]);

        $params = [
            'code' => $request->input('code'),
            'po_type' => $request->input('po_type'),
            'po_created' => $request->input('po_created'),
            'shipping_date' => $request->input('shipping_date'),
            'supplier_type' => $request->input('supplier_type'),
            'walk_in_supplier' => $request->input('walk_in_supplier'),
            'walk_in_supplier_detail' => $request->input('walk_in_supplier_detail'),
            'remarks' => $request->input('remarks'),
            'status' => Lookup::whereCode('POSTATUS.WA')->first()->code,
            'supplier_id' => $request->input('supplier_id'),
            'vendor_trucking_id' => $request->input('vendor_trucking_id'),
            'warehouse_id' => $request->input('warehouse_id'),
            'store_id' => Auth::user()->store_id
        ];

        $po = PurchaseOrder::create($params);

        for($i = 0; $i < count($request->input('product_id')); $i++)
        {
            $item = new Items();
            $item->product_id = $request->input("product_id.$i");
            $item->store_id = Auth::user()->store_id;
            $item->selected_unit_id = $request->input("selected_unit_id.$i");
            $item->base_unit_id = $request->input("base_unit_id.$i");
            $item->conversion_value = ProductUnit::where(['product_id' => $item->product_id, 'unit_id' => $item->selected_unit_id])->first()->conversion_value;
            $item->quantity = $request->input("quantity.$i");
            $item->price = $request->input("price.$i");
            $item->to_base_quantity = $item->quantity * $item->conversion_value;

            $po->items()->save($item);
        }

        return redirect(route('db.po.create'));
    }

    public function index(){
        $purchaseOrders = PurchaseOrder::with('supplier')->whereIn('status', ['POSTATUS.WA', 'POSTATUS.WP'])->get();
        $poStatusDDL = Lookup::where('category', '=', 'POSTATUS')->get()->pluck('description', 'code');

        return view('purchase_order.index', compact('purchaseOrders', 'poStatusDDL', 'warehouseDDL', 'vendorTruckingDDL'));
    }

    public function revise($id){
        $currentPo = PurchaseOrder::with('items.product.productUnits.unit', 'supplier', 'vendorTrucking', 'warehouse')->find($id);
        $productDDL = Product::with('productUnits.unit')->get();
        $warehouseDDL = Warehouse::all([ 'id', 'name' ]);
        $vendorTruckingDDL = VendorTrucking::all([ 'id', 'name' ]);

        return view('purchase_order.revise', compact('currentPo', 'productDDL', 'warehouseDDL', 'vendorTruckingDDL'));
    }

    public function saveRevision(Request $request, $id){
        $currentPo = PurchaseOrder::find($id);

        $currentPo->items()->detach();

        for($i = 0; $i < count($request->input('product_id')); $i++)
        {
            $item = new Items();
            $item->product_id = $request->input("product_id.$i");
            $item->store_id = Auth::user()->store_id;
            $item->selected_unit_id = $request->input("selected_unit_id.$i");
            $item->base_unit_id = $request->input("base_unit_id.$i");
            $item->conversion_value = ProductUnit::where(['product_id' => $item->product_id, 'unit_id' => $item->selected_unit_id])->first()->conversion_value;
            $item->quantity = $request->input("quantity.$i");
            $item->price = $request->input("price.$i");
            $item->to_base_quantity = $item->quantity * $item->conversion_value;

            $currentPo->items()->save($item);
        }

        $currentPo->remarks = $request->input('remarks');
        $currentPo->warehouse_id = $request->input('warehouse_id');
        $currentPo->vendor_trucking_id = $request->input('vendor_trucking_id');
        $currentPo->save();

        return redirect(route('db.po.revise.index'));
    }

    public function payment($id){

    }

    public function savePayment(Request $request, $id){

    }

    public function delete(Request $request, $id){
        $po = PurchaseOrder::find($id);
        $po->items()->detach();
        $po->payments()->detach();
        $po->delete();

        return redirect(route('db.po.revise.index'));
    }
}