<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 11/24/2016
 * Time: 12:48 AM
 */

namespace App\Services;

use Illuminate\Http\Request;
use Doctrine\Common\Collections\Collection;

interface StockService
{
    /**
     * Get all stocks with related data which meet sales requirement.
     *
     * @return Collection stocks ready to be sold.
     */
    public function getStocksForSO();

    /**
     * Get the information of all stocks at current time. 
     *
     * @return Collection
     */
    public function getCurrentStocks($warehouseId = null);

    public function searchStock($keyword);

    public function getStockWithSameProductId();

    public function getStockByProduct($product_id);

    public function createMergeStock(Request $request);

    public function deleteStock($stock_id);

    public function doStockIn($poId, $stockMergeId, $productId, $warehouseId, $qty);

    public function doStockOut($soId, $productId, $warehouseId, $stockId, $stockMergeId, $qty);
}