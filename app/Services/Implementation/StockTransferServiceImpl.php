<?php
/**
 * Created by PhpStorm.
 * User: Rudy Setiady
 * Date: 07/04/2017
 * Time: 17.05
 */

namespace App\Services\Implementation;

use App\Model\StockTransfer;
use App\Model\Stock;
use App\Model\StockIn;
use App\Model\StockOut;
use App\Services\StockTransferService;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;

class StockTransferServiceImpl implements StockTransferService
{

    public function transfer(Request $request)
    {
        Log::info("[StockTransferServiceImpl@transfer]");

        DB::transaction(function () use ($request) {

            $user = Auth::user();

            $stockTransfer = [
                'store_id' => $user->store_id,
                'po_id' => $request->input('po_id'),
                'product_id' => $request->input('product_id'),
                'transfer_date' => date('Y-m-d H:i:s', strtotime($request->input('transfer_date'))),
                'source_warehouse_id' => $request->input('source_warehouse_id'),
                'destination_warehouse_id' => $request->input('destination_warehouse_id'),
                'quantity' => $request->input('quantity'),
                'reason' => $request->input('remarks')
            ];
            $st = StockTransfer::create($stockTransfer);

            $stock_id = $request->input('stock_id');

            $stockOut = [
                'store_id' => $user->store_id,
                'product_id' => $st->product_id,
                'stock_id' => $stock_id,
                'warehouse_id' => $st->source_warehouse_id,
                'quantity' => $st->quantity,
                'stock_trf_id' => $st->id,
            ];
            $sto = StockOut::create($stockOut);

            $stockIn = [
                'store_id' => $user->store_id,
                'product_id' => $st->product_id,
                'stock_id' => $stock_id,
                'warehouse_id' => $st->destination_warehouse_id,
                'quantity' => $st->quantity,
                'stock_trf_id' => $st->id,
            ];
            $sti = StockIn::create($stockIn);

            $stock = Stock::find($stock_id);
            $stock->current_quantity = $stock->current_quantity - $sto->quantity;
            $stock->save();

            return $st;
        });
    }
}