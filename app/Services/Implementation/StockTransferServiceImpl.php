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
use App\Services\StockTransferService;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Doctrine\Common\Collections\Collection;

use Illuminate\Support\Facades\Log;

class StockTransferServiceImpl implements StockTransferService
{

    public function transfer(Request $request)
    {
        DB::transaction(function () use ($request) {

            $user = Auth::user();

            Log::info($request);

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

            $stock_id = $request->input('stock_id');

            $stock = Stock::find($stock_id);
            $stock->current_quantity = $stock->current_quantity - $stockTransfer->quantiy;
            $stock->save();

            $st = StockTransfer::create($stockTransfer);

            return $st;
        });
    }
}