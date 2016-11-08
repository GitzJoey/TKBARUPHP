<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/26/2016
 * Time: 6:55 PM
 */

namespace App\Http\Controllers;

use App\Model\Customer;
use App\Model\Item;
use App\Model\Lookup;
use App\Model\Product;
use App\Model\ProductUnit;
use App\Model\PurchaseOrder;
use App\Model\SalesOrder;
use App\Model\Stock;
use App\Model\VendorTrucking;
use App\Model\Warehouse;
use App\Util\SOCodeGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SalesOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        Log::info('SalesOrderController@create');

        $customerDDL = Customer::all(['id', 'name']);
        $warehouseDDL = Warehouse::all(['id', 'name']);
        $vendorTruckingDDL = VendorTrucking::all(['id', 'name']);
        $productDDL = Product::with('productUnits.unit')->get();
        $stocksDDL = Stock::with('product.productUnits.unit')->orderBy('product_id', 'asc')
            ->orderBy('created_at', 'asc')->where('current_quantity', '>', 0)->get();
        $soTypeDDL = Lookup::where('category', '=', 'SOTYPE')->get(['code', 'description']);
        $customerTypeDDL = Lookup::where('category', '=', 'CUSTOMERTYPE')->get(['code', 'description']);
        $soCode = SOCodeGenerator::generateSOCode();
        $soStatusDraft = Lookup::where('category', '=', 'SOSTATUS')->get(['description', 'code'])->where('code', '=',
            'SOSTATUS.D');

        $userSOs = session('userSOs', collect([]));

        return view('sales_order.create', compact('soTypeDDL', 'customerTypeDDL', 'warehouseDDL',
            'productDDL', 'stocksDDL', 'vendorTruckingDDL', 'customerDDL'
            , 'soCode', 'soStatusDraft', 'userSOs'));
    }

    public function store(Request $request)
    {
        Log::info('SalesOrderController@store');

        $submitIndex = $request->input('submit');
        $cancelIndex = $request->input('cancel');

        Log::info("SalesOrderController@store submitIndex = $submitIndex");
        Log::info("SalesOrderController@store cancelIndex = $cancelIndex");

        if(!is_null($submitIndex)){
            if ($request->input("customer_type.$submitIndex") == 'CUSTOMERTYPE.R'){
                $customer_id = empty($request->input("customer_id.$submitIndex")) ? 0 :$request->input("customer_id.$submitIndex");
                $walk_in_cust = '';
                $walk_in_cust_detail = '';
            } else {
                $customer_id = 0;
                $walk_in_cust = $request->input("walk_in_customer.$submitIndex");
                $walk_in_cust_detail = $request->input("walk_in_customer_details.$submitIndex");
            }

            $params = [
                'customer_type' => $request->input("customer_type.$submitIndex"),
                'customer_id' => $customer_id,
                'walk_in_cust' => $walk_in_cust,
                'walk_in_cust_detail' => $walk_in_cust_detail,
                'code' => $request->input("so_code.$submitIndex"),
                'so_type' => $request->input("sales_type.$submitIndex"),
                'so_created' => date('Y-m-d', strtotime($request->input("so_created.$submitIndex"))),
                'shipping_date' => date('Y-m-d', strtotime($request->input("shipping_date.$submitIndex"))),
                'status' => Lookup::whereCode('SOSTATUS.WD')->first()->code,
                'vendor_trucking_id' => empty($request->input("vendor_trucking_id.$submitIndex")) ? 0 : $request->input("vendor_trucking_id.$submitIndex"),
                'warehouse_id' => $request->input("warehouse_id.$submitIndex"),
                'remarks' => $request->input("remarks.$submitIndex"),
                'store_id' => Auth::user()->store_id
            ];

            $so = SalesOrder::create($params);

            for ($j = 0; $j < count($request->input("so_$submitIndex"."_product_id")); $j++) {
                $item = new Item();
                $item->product_id = $request->input("so_$submitIndex"."_product_id.$j");
                $item->stock_id = empty($request->input("so_$submitIndex"."_stock_id.$j")) ? 0 : $request->input("so_$submitIndex"."_stock_id.$j");
                $item->store_id = Auth::user()->store_id;
                $item->selected_unit_id = $request->input("so_$submitIndex"."_selected_unit_id.$j");
                $item->base_unit_id = $request->input("so_$submitIndex"."_base_unit_id.$j");
                $item->conversion_value = ProductUnit::where([
                    'product_id' => $item->product_id,
                    'unit_id' => $item->selected_unit_id
                ])->first()->conversion_value;
                $item->quantity = $request->input("so_$submitIndex"."_quantity.$j");
                $item->price = floatval(str_replace(',', '', $request->input("so_$submitIndex"."_price.$j")));
                $item->to_base_quantity = $item->quantity * $item->conversion_value;

                $so->items()->save($item);
            }
        }

        //Always save to session.
        //Save all SOs except the SO to be submitted or cancelled (indicated from it's index).
        //If it is a submission, get the index from submitIndex
        //If it is cancellation, get the index from cancelIndex
        //If there is no index to be excluded, it's mean all SOs must be saved as draft.
        // (negative index means there is no exclusion)
        $this->storeToSession($request, isset($submitIndex) ? $submitIndex : isset($cancelIndex) ? $cancelIndex : -1);

        if(count($request->input('so_code')) > 1)
            return redirect(route('db.so.create'));
        else
            return redirect(route('db'));
    }

    public function index()
    {
        Log::info('SalesOrderController@index');

        $salesOrders = SalesOrder::with('customer')->whereIn('status', ['SOSTATUS.WA', 'SOSTATUS.WD'])->get();
        $soStatusDDL = Lookup::where('category', '=', 'SOSTATUS')->get()->pluck('description', 'code');

        return view('sales_order.index', compact('salesOrders', 'soStatusDDL'));
    }

    public function revise($id)
    {
        Log::info('SalesOrderController@revise');

        $currentSo = SalesOrder::with('items.product.productUnits.unit', 'customer.profiles.phoneNumbers.provider',
            'customer.bankAccounts.bank', 'vendorTrucking', 'warehouse')->find($id);
        $warehouseDDL = Warehouse::all(['id', 'name']);
        $vendorTruckingDDL = VendorTrucking::all(['id', 'name']);
        $productDDL = Product::with('productUnits.unit')->get();
        $stocksDDL = Stock::with('product.productUnits.unit')->orderBy('product_id', 'asc')
            ->orderBy('created_at', 'asc')->where('current_quantity', '>', 0)->get();
        $customerDDL = [];
        if ($currentSo->customer_id != 0) {
            $customerDDL = Customer::with('bankAccounts', 'profiles.phoneNumbers.provider')->where('id', '=', $currentSo->customer->id)->get();
        }

        return view('sales_order.revise', compact('currentSo', 'productDDL', 'warehouseDDL', 'vendorTruckingDDL', 'stocksDDL', 'customerDDL'));
    }

    public function saveRevision(Request $request, $id)
    {
        // Get current SO
        $currentSo = SalesOrder::with('items')->find($id);

        // Get ID of current SO's items
        $soItemsId = $currentSo->items->map(function ($item) {
            return $item->id;
        })->all();

        // Get the id of removed items
        $soItemsToBeDeleted = array_diff($soItemsId, $request->input('item_id'));

        // Remove the item that removed on the revise page
        Item::destroy($soItemsToBeDeleted);

        $currentSo->warehouse_id = $request->input('warehouse_id');
        $currentSo->shipping_date = date('Y-m-d', strtotime($request->input('shipping_date')));
        $currentSo->remarks = $request->input('remarks');
        $currentSo->vendor_trucking_id = empty($request->input('vendor_trucking_id')) ? 0 : $request->input('vendor_trucking_id');

        for ($i = 0; $i < count($request->input('item_id')); $i++) {
            $item = Item::findOrNew($request->input("item_id.$i"));
            $item->product_id = $request->input("product_id.$i");
            $item->stock_id = empty($request->input("stock_id.$i")) ? 0 : $request->input("stock_id.$i");
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

            $currentSo->items()->save($item);
        }

        $currentSo->save();

        return redirect(route('db.so.revise.index'));
    }

    public function payment($id)
    {

    }

    public function savePayment(Request $request, $id)
    {

    }

    public function delete(Request $request, $id)
    {
        $so = SalesOrder::find($id);

        $so->status = 'SOSTATUS.RJT';
        $so->save();

        return redirect(route('db.so.revise.index'));
    }

    private function storeToSession(Request $request, $filteredIndex)
    {
        Log::info("Filtered index : $filteredIndex");

        $SOs = [];

        for($i = 0; $i < count($request->input('so_code')); $i++){
            if($i != $filteredIndex){
                $items = [];
                for ($j = 0; $j < count($request->input("so_$i"."_product_id")); $j++) {
                    $items[] = [
                        'quantity' => $request->input("so_$i"."_quantity.$j"),
                        'selected_unit' => [
                            'conversion_value' => ProductUnit::where([
                                'product_id' => $request->input("so_$i"."_product_id.$j"),
                                'unit_id' => $request->input("so_$i"."_selected_unit_id.$j")
                            ])->first()->conversion_value,
                            'unit' => [
                                'id' => $request->input("so_$i"."_selected_unit_id.$j")
                            ]
                        ],
                        'product' => Product::with('productUnits.unit')->find($request->input("so_$i"."_product_id.$j")),
                        'stock_id' => empty($request->input("so_$i"."stock_id.$i")) ? 0 : $request->input("so_$i"."_stock_id.$j"),
                        'base_unit' => [
                            'unit' => [
                                'id' => $request->input("so_$i"."_base_unit_id.$j")
                            ]
                        ],
                        'price' => floatval(str_replace(',', '', $request->input("so_$i"."_price.$j")))
                    ];
                }

                $SOs[] = [
                    'customer_type' => [
                        'code' => $request->input("customer_type.$i")
                    ],
                    'customer' => Customer::find($request->input("customer_id.$i")),
                    'walk_in_cust' => $request->input("walk_in_customer.$i"),
                    'walk_in_cust_details' => $request->input("walk_in_customer_details.$i"),
                    'so_code' => $request->input("so_code.$i"),
                    'sales_type' => [
                        'code' => $request->input("sales_type.$i")
                    ],
                    'so_created' => $request->input("so_created.$i"),
                    'shipping_date' => $request->input("shipping_date.$i"),
                    'warehouse' => [
                        'id' => $request->input("warehouse_id.$i")
                    ],
                    'vendorTrucking' => [
                        'id' => empty($request->input("vendor_trucking_id.$i")) ? 0 : $request->input("vendor_trucking_id.$i")
                    ],
                    'remarks' => $request->input("remarks.$i"),
                    'items' => $items
                ];
            }
        }

        session(['userSOs' => collect($SOs)]);
    }
}