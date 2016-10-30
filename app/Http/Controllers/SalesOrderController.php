<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/26/2016
 * Time: 6:55 PM
 */

namespace App\Http\Controllers;

use App\Model\Customer;
use App\Model\Lookup;
use App\Model\Product;
use App\Model\ProductUnit;
use App\Model\PurchaseOrder;
use App\Model\SalesOrder;
use App\Model\VendorTrucking;
use App\Model\Warehouse;
use App\Util\SOCodeGenerator;
use Illuminate\Http\Request;

class SalesOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $customerDDL = Customer::all(['id', 'name']);
        $warehouseDDL = Warehouse::all(['id', 'name']);
        $vendorTruckingDDL = VendorTrucking::all(['id', 'name']);
        $productDDL = Product::with('productUnits.unit')->get();
        $soTypeDDL = Lookup::where('category', '=', 'SOTYPE')->get()->pluck('description', 'code');
        $customerTypeDDL = Lookup::where('category', '=', 'CUSTOMERTYPE')->get()->pluck('description', 'code');
        $soCode = SOCodeGenerator::generateSOCode();
        $soStatusDraft = Lookup::where('category', '=', 'SOSTATUS')->get(['description', 'code'])->where('code', '=',
            'SOSTATUS.D');

        $stocksDDL = '';

        return view('sales_order.create', compact('soTypeDDL', 'customerTypeDDL', 'warehouseDDL',
            'productDDL', 'stocksDDL', 'vendorTruckingDDL', 'customerDDL'
            , 'soCode', 'soStatusDraft'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code' => 'required|string|max:255',
            'so_type' => 'required|string|max:255',
            'so_created' => 'required|string|max:255',
            'shipping_date' => 'required|string|max:255',
            'customer_type' => 'required|string|max:255',
        ]);

        $params = [
            'code' => $request->input('code'),
            'so_type' => $request->input('so_type'),
            'so_created' => $request->input('so_created'),
            'shipping_date' => $request->input('shipping_date'),
            'customer_type' => $request->input('supplier_type'),
            'walk_in_cust' => $request->input('walk_in_cust'),
            'walk_in_cust_detail' => $request->input('walk_in_cust_detail'),
            'remarks' => $request->input('remarks'),
            'status' => Lookup::whereCode('SOSTATUS.WA')->first()->code,
            'customer_id' => $request->input('customer_id'),
            'vendor_trucking_id' => $request->input('vendor_trucking_id'),
            'warehouse_id' => $request->input('warehouse_id'),
            'store_id' => Auth::user()->store_id
        ];

        $so = SalesOrder::create($params);

        for ($i = 0; $i < count($request->input('product_id')); $i++) {
            $item = new Item();
            $item->product_id = $request->input("product_id.$i");
            $item->store_id = Auth::user()->store_id;
            $item->selected_unit_id = $request->input("selected_unit_id.$i");
            $item->base_unit_id = $request->input("base_unit_id.$i");
            $item->conversion_value = ProductUnit::where([
                'product_id' => $item->product_id,
                'unit_id' => $item->selected_unit_id
            ])->first()->conversion_value;
            $item->quantity = $request->input("quantity.$i");
            $item->price = $request->input("price.$i");
            $item->to_base_quantity = $item->quantity * $item->conversion_value;

            $so->item()->save($item);
        }

        return redirect(route('db.so.create'));
    }

    public function index()
    {
        $salesorder = SalesOrder::all();
        $soStatusDDL = Lookup::where('category', '=', 'SOSTATUS')->get()->pluck('description', 'code');

        return view('sales_order.index', compact('salesorder', 'soStatusDDL'));
    }

    public function revise($id)
    {

        $currentSales = '';

        return view('sales_order.revise', compact('currentSales', 'productDDL'));
    }

    public function saveRevision(Request $request, $id)
    {

    }

    public function payment($id)
    {

    }

    public function savePayment(Request $request, $id)
    {

    }

    public function delete(Request $request, $id)
    {
        $so = PurchaseOrder::find($id);

        $so->status = 'SOSTATUS.RJT';
        $so->save();

        return redirect(route('db.so.revise.index'));
    }
}