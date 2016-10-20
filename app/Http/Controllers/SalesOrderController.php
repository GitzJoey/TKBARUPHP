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
use App\Model\Warehouse;
use App\Model\VendorTrucking;

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
        $stocksDDL = '';

        $vendortruckingDDL = VendorTrucking::whereStatus('STATUS.active')->get(['name', 'id']);


        return view('sales_order.create', compact('statusDDL', 'soTypeDDL', 'customerTypeDDL', 'warehouseDDL' ,'productDDL', 'stocksDDL'));
    }

}