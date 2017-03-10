<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Model\ProductType;
use App\Model\Stock;

class StockHistoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('permission:report.stock-history', ['only' => ['stockTypeIndex']]);
	}
    public function stockTypeIndex(Request $request){

		/* search */
		$type_ids = !empty($type_ids)? $type_ids : null;
		$to_json = trim($request->get('to_json'));
		$to_json = !empty($to_json)? true : false;

        $prodtypeDdL = ProductType::with('stocks.soItems.itemable.customer', 'stocks.soItems.selectedUnit.unit', 'stocks.product', 'stocks.purchaseOrder');
        if (!is_null($type_ids)){
			$prodtypeDdL = $prodtypeDdL->whereIn('id', $type_ids);
		}
        return response()->json($prodtypeDdL->get());
    }

}
