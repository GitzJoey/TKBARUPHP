<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/26/2016
 * Time: 6:55 PM
 */

namespace App\Http\Controllers;

use App\Lookup;
use App\VendorTrucking;

class SalesOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $statusDDL = Lookup::where('category', '=', 'STATUS')->get()->pluck('description', 'code');
        $soTypeDDL = Lookup::where('category', '=', 'SO_TYPE')->get()->pluck('description', 'code');

        $vendortruckingDDL = VendorTrucking::whereStatus('STATUS.active')->get(['name', 'id']);


        return view('sales_order.create', compact('statusDDL', 'soTypeDDL'));
    }

}