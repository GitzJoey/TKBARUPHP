<?php
/**
 * Created by PhpStorm.
 * User: Rudy Setiady
 * Date: 07/04/2017
 * Time: 17.05
 */

namespace App\Services\Implementation;

use App\Model\StockTransfer;
use App\Services\Request;
use App\Services\StockService;
use Illuminate\Support\Facades\Auth;

class StockTransferServiceImpl implements StockTransferService
{

    public function transfer(Request $request)
    {
        DB::transaction(function () use ($request) {

            $params = [
                'store_id' => Auth::user()->store_id,
                'po_id' => $request->input('po_id'),
                'product_id' => $request->input('product_id'),
                'transfer_date' => date('Y-m-d H:i:s', strtotime($request->input('transfer_date'))),
                'source_warehouse_id' => $request->input('source_warehouse_id'),
                'destination_warehouse_id' => $request->input('destination_warehouse_id'),
                'quantity' => $request->input('quantity'),
                'cost' => $request->input('cost'),
                'reason' => $request->input('reason')
            ];

            $st = StockTransfer::create($params);

            return $st;
        });
    }
}