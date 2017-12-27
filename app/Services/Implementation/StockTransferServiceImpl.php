<?php
/**
 * Created by PhpStorm.
 * User: Rudy Setiady
 * Date: 07/04/2017
 * Time: 17.05
 */

namespace App\Services\Implementation;

use App\Model\Stock;
use App\Model\StockIn;
use App\Model\StockOut;
use App\Model\StockTransfer;

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

        DB::beginTransaction();

        try {
            $user = Auth::user();

            $stockTransfer = [
                'store_id' => $user->store_id,
                'stock_id' => $request->input('stock_id'),
                'product_id' => $request->input('product_id'),
                'transfer_date' => date('Y-m-d H:i:s', strtotime($request->input('transfer_date'))),
                'source_warehouse_id' => $request->input('source_warehouse_id'),
                'destination_warehouse_id' => $request->input('destination_warehouse_id'),
                'quantity' => $request->input('quantity'),
                'reason' => $request->input('remarks')
            ];

            $st = StockTransfer::create($stockTransfer);

            $stock = Stock::find($request->input('stock_id'));
            $stock->current_quantity -= $st->quantity;
            $stock->save();

            $stockOutParam = [
                'store_id' => $user->store_id,
                'product_id' => $st->product_id,
                'stock_id' => $stock->id,
                'warehouse_id' => $st->source_warehouse_id,
                'stock_trf_id' => $st->id,
                'quantity' => $st->quantity
            ];

            StockOut::create($stockOutParam);

            if (strtoupper($request->input('newOrExistingStock')) == 'NEWSTOCK') {
                $stockParams = [
                    'store_id' => Auth::user()->store_id,
                    'po_id' => 0,
                    'stock_merge_id' => 0,
                    'product_id' => $st->product_id,
                    'warehouse_id' => $st->destination_warehouse_id,
                    'quantity' => $st->quantity,
                    'current_quantity' => $st->quantity
                ];

                $stock = Stock::create($stockParams);

                $stockIn = [
                    'store_id' => $user->store_id,
                    'product_id' => $st->product_id,
                    'stock_id' => $stock->id,
                    'warehouse_id' => $st->destination_warehouse_id,
                    'quantity' => $st->quantity,
                    'stock_trf_id' => $st->id,
                ];

                StockIn::create($stockIn);
            } else {
                $dest_stock = Stock::find($request->input('destination-stocks'));
                $dest_stock->current_quantity += $st->quantity;
                $dest_stock->save();

                $stockIn = [
                    'store_id' => $user->store_id,
                    'product_id' => $st->product_id,
                    'stock_id' => $dest_stock->id,
                    'warehouse_id' => $st->destination_warehouse_id,
                    'quantity' => $st->quantity,
                    'stock_trf_id' => $st->id,
                ];

                StockIn::create($stockIn);
            }

            DB::commit();
            return $st;
        } catch (Exception $e) {
            DB::rollBack();
        }
    }
}