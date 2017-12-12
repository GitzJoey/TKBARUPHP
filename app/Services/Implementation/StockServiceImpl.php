<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 11/24/2016
 * Time: 12:51 AM
 */

namespace App\Services\Implementation;

use App\Model\Stock;
use App\Services\StockService;
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
    public function getCurrentStocks($warehouseId)
    {
        $stocks = null;

        if (is_null($warehouseId) || empty($warehouseId) || $warehouseId == 0) {
            $stocks = Stock::with('product')->get();
        } else {
            $stocks = Stock::with('product')->where('warehouse_id', '=', $warehouseId)->get();
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
        $result = Stock::with('product', 'purchaseOrder')->whereProductId($product_id)->get();

        return $result;
    }
}