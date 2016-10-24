<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/26/2016
 * Time: 6:55 PM
 */

namespace App\Http\Controllers;

use App\Model\Lookup;
use App\Model\Product;
use App\Model\Customer;
use App\Model\Warehouse;
use App\Model\VendorTrucking;

use App\Util\SOCodeGenerator;

class SalesOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $soTypeDDL = Lookup::where('category', '=', 'SOTYPE')->get()->pluck('description', 'code');
        $customerTypeDDL = Lookup::where('category', '=', 'CUSTOMERTYPE')->get()->pluck('description', 'code');
        $warehouseDDL = Warehouse::whereStatus('STATUS.Active')->get(['name', 'id']);
        $productDDL = Product::whereStatus('STATUS.Active')->get(['name', 'id']);
        $soCode = SOCodeGenerator::generateWithLength(6);
        $customerDDL = Customer::all([ 'id', 'name' ]);
        $vendortruckingDDL = VendorTrucking::whereStatus('STATUS.active')->get(['name', 'id']);
        $soStatusDraft = Lookup::where('category', '=', 'SOSTATUS')->get(['description', 'code'])->where('code', '=', 'SOSTATUS.D');

        $stocksDDL = '';

        return view('sales_order.create', compact(
            'statusDDL', 'soTypeDDL', 'customerTypeDDL', 'warehouseDDL',
            'productDDL', 'stocksDDL', 'vendortruckingDDL', 'customerDDL'
            , 'soCode', 'soStatusDraft'));
    }

    public function store(Request $request)
    {

        return redirect(route('db.so.create'));
    }

    public function index(){
        $salesorder = '';
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

        $so->items()->detach();
        $so->payments()->detach();
        $so->delete();

        return redirect(route('db.so.revise.index'));
    }
}