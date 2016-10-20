<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 2:17 PM
 */

namespace App\Http\Controllers;

use App\Model\Item;
use App\Model\Lookup;
use App\Model\Product;
use App\Model\ProductUnit;
use App\Model\Store;
use App\Model\Supplier;
use App\Model\Warehouse;
use App\Model\PurchaseOrder;
use App\Model\VendorTrucking;

use Illuminate\Http\Request;
use App\Util\POCodeGenerator;

class PurchaseOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        //Use get all for now because the mechanism to set record status to 'Active' is not working.
        $supplierDDL = Supplier::all([ 'id', 'name' ]);
        $warehouseDDL = Warehouse::all([ 'id', 'name' ]);
        $vendorTruckingDDL = VendorTrucking::all([ 'id', 'name' ]);
        $productDDL = Product::with('productUnits.unit')->get();
        $poTypeDDL = Lookup::where('category', '=', 'POTYPE')->get(['description', 'code']);
        $supplierTypeDDL = Lookup::where('category', '=', 'SUPPLIERTYPE')->get(['description', 'code']);
        $poCode = POCodeGenerator::generateWithLength(6);
        $poStatus = Lookup::where('code', '=', 'POSTATUS.WA')->get(['description', 'code']);

        return view('purchase_order.create', compact(
            'supplierDDL',
            'warehouseDDL',
            'vendorTruckingDDL',
            'supplierTypeDDL',
            'poTypeDDL',
            'unitDDL',
            'productDDL',
            'poStatus',
            'poCode'));
    }

    public function store(Request $request)
    {
        $params = [
            'code' => $request->input('code'),
            'po_type' => $request->input('po_type'),
            'po_created' => $request->input('po_created'),
            'shipping_date' => $request->input('shipping_date'),
            'supplier_type' => $request->input('supplier_type'),
            'walk_in_supplier' => $request->input('walk_in_supplier'),
            'walk_in_supplier_detail' => $request->input('walk_in_supplier_detail'),
            'remarks' => $request->input('remarks'),
            'status' => $request->input('status')
        ];

        $po = PurchaseOrder::create($params);

        $selectedSupplier = Supplier::find($request->input('supplier_id'));
        $selectedSupplier->purchaseOrders()->save($po);

        $vendorTrucking = VendorTrucking::find($request->input('vendor_trucking_id'));
        $vendorTrucking->purchaseOrders()->save($po);

        $warehouse = Warehouse::find($request->input('warehouse_id'));
        $warehouse->purchaseOrders()->save($po);

        /*
         * TODO: Don't know how to retrieve current user store id yet, must be replaced later
         */
        $store = Store::find(1);
        $store->purchaseOrders()->save($po);

        for($i = 0; $i < count($request['product_id']); $i++)
        {
            $item = new Item();
            $item->product_id = $request["product_id"][$i];
            $item->store_id = $store->id;
            /**
             * TODO: Don't know how to get stock for the item yet, must be replaced later
             */
            $item->selected_unit_id = $request["selected_unit_id"][$i];
            $item->base_unit_id = $request["base_unit_id"][$i];
            $item->conversion_value = ProductUnit::where(
                ['product_id' => $item->product_id, 'unit_id' => $item->selected_unit_id]
            )->first()->conversion_value;
            $item->quantity = $request["quantity"][$i];
            $item->price = $request["price"][$i];
            $item->to_base_quantity = $item->quantity * $item->conversion_value;

            $po->items()->save($item);
        }

        return redirect(route('db.po.create'));
    }
}