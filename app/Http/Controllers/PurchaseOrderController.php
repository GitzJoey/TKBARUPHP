<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 2:17 PM
 */

namespace App\Http\Controllers;

use App\Model\Lookup;
use App\Model\Product;
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
        $supplierDDL = Supplier::all([ 'id', 'name', 'address', 'city', 'phone_number', 'fax_num' ]);
        $warehouseDDL = Warehouse::all([ 'id', 'name' ]);
        $vendorTruckingDDL = VendorTrucking::all([ 'id', 'name' ]);
        $productDDL = Product::with('getProductUnit.getUnit')->get();
        $poTypeDDL = Lookup::where('category', '=', 'POTYPE')->get(['description', 'code' ]);
        $poCode = POCodeGenerator::generateWithLength(6);

        return view('purchase_order.create', compact('supplierDDL', 'warehouseDDL', 'vendorTruckingDDL', 'productDDL', 'poTypeDDL', 'poCode'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[

        ]);

        $params = [
            'code' => $request->input('po_code'),
            'po_type' => $request->input('po_type'),
            'po_created' => $request->input('po_created'),
            'shipping_date' => $request->input('shipping_date'),
            'remarks' => $request->input('remarks'),
            'status' => $request->input('status')
        ];

        $po = PurchaseOrder::create($request->input('remarks'));

        $selectedSupplier = Supplier::find($request->input('supplier_id'));
        $selectedSupplier->getPurchaceOrders()->save($po);

    }
}