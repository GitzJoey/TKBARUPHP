<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 11/24/2016
 * Time: 12:51 AM
 */

namespace App\Services\Implementation;

use App\Model\Stock;

use App\Model\StockMerge;
use App\Model\StockMergeDetail;

use App\Services\StockService;

use DB;
use Illuminate\Http\Request;
use Doctrine\Common\Collections\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StockServiceImpl implements StockService
{

    /**
     * Get all stocks with related data for sales.
     *
     * @return Collection stocks ready to be sold.
     */
    public function getStocksForSO()
    {
        //Get current user
        $user = Auth::user();

        //Get all stocks which have current quantity more than 0 and belongs to current user's store.
        $stocks = Stock::with('product.productUnits.unit')
            ->orderBy('product_id', 'asc')
            ->orderBy('created_at', 'asc')
            ->where('current_quantity', '>', 0)
            ->where('store_id', '=', $user->store_id)
            ->get();

        //Assign today prices additional attribute
        $stocks = collect($stocks->map(function ($stock){
            return array_merge([
                'today_prices' => $stock->todayPrices(),
                'latest_prices' => $stock->latestPrices()
            ], $stock->toArray());
        })->all());

        return $stocks;
    }

    /**
     * Get the information of all stocks at current time. 
     *
     * @param Integer $warehouseId selected warehouse Id, if null or 0 will return from all warehouses.
     * @return Collection
     */
    public function getCurrentStocks($warehouseId = null)
    {
        $stocks = null;

        if (is_null($warehouseId) || empty($warehouseId) || $warehouseId == 0) {
            $stocks = Stock::with('product.type', 'warehouse')->get();
        } else {
            $stocks = Stock::with('product.type', 'warehouse')->where('warehouse_id', '=', $warehouseId)->get();
        }

        //Assign latest prices additional attribute
        $stocks = collect($stocks->map(function ($stock){
            return array_merge(['latest_prices' => $stock->latestPrices()], $stock->toArray());
        })->all());

        return $stocks;
    }

    public function searchStock($keyword)
    {

    }

    public function getStockWithSameProductId()
    {
        $result = Stock::groupBy('product_id')->havingRaw('COUNT(*) > 1')
            ->select('product_id')->get()->map(function ($stock) {
                return array_merge(['product_id' => $stock->product_id, 'name' => $stock->product->name]);
            });

        return $result;
    }

    public function getStockByProduct($product_id)
    {
        $result = Stock::with('product', 'purchaseOrder', 'warehouse')->whereProductId($product_id)->get();

        return $result;
    }

    public function createMergeStock(Request $request)
    {
        DB::beginTransaction();

        try
        {
            $sm = new StockMerge();
            $sm->merge_date = date(config('const.DATETIME_FORMAT.DATABASE_DATETIME'), strtotime($request['merge_date']));
            $sm->merge_type = $request['merge_type'];
            $sm->product_id = $request['product_id'];
            $sm->merged_price = 0;
            $sm->remarks = $request['remarks'];

            $sm->save();

            $stocks = Stock::whereIn('id', $request['selected_merge'])->get();

            $qty = 0;

            foreach ($stocks as $s) {
                $smd = new StockMergeDetail();
                $smd->po_id = $s->purchaseOrder->id;
                $smd->before_merge_qty = $s->current_quantity;

                foreach ($s->purchaseOrder->items as $i) {
                    if ($i->product->id = $s->product_id) {
                        $smd->before_merge_price = $i->price;
                    }
                }

                $sm->stockMergeDetails()->save($smd);

                //delete the stock
                $this->deleteStock($s->id);

                $qty += $s->current_quantity;

                $this->doStockOut(0, $s->product_id, $s->warehouse_id, $s->id, $sm->id, $s->current_quantity);
            }

            $this->doStockIn(0, $sm->id, $stocks->first()->product->id, $stocks->first()->warehouse->id, $qty);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    public function deleteStock($stock_id)
    {
        $stock = Stock::whereId($stock_id)->first();
        $stock->delete();
    }

    public function doStockIn($poId, $stockMergeId, $productId, $warehouseId, $qty)
    {
        $stockParams = [
            'store_id' => Auth::user()->store_id,
            'po_id' => $poId,
            'stock_merge_id' => $stockMergeId,
            'product_id' => $productId,
            'warehouse_id' => $warehouseId,
            'quantity' => $qty,
            'current_quantity' => $qty
        ];

        $stock = Stock::create($stockParams);

        $stockInParams = [
            'store_id' => Auth::user()->store_id,
            'po_id' => $poId,
            'stock_merge_id' => $stockMergeId,
            'product_id' => $productId,
            'warehouse_id' => $warehouseId,
            'stock_id' => $stock->id,
            'quantity' => $qty
        ];

        $stockIn = StockIn::create($stockInParams);
    }

    public function doStockOut($soId, $productId, $warehouseId, $stockId, $stockMergeId, $qty)
    {
        $stockOutParams = [
            'store_id' => Auth::user()->store_id,
            'so_id' => $soId,
            'product_id' => $productId,
            'warehouse_id' => $warehouseId,
            'stock_merge_id' => $stockMergeId,
            'stock_id' => $stockId,
            'quantity' => $qty
        ];

        $stockOut = StockOut::create($stockOutParams);

        $stock = Stock::find($stockId);
        $stock->current_quantity -= $qty;
        $stock->save();
    }
}