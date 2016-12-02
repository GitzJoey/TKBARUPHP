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
                'today_prices' => $stock->todayPrices()
            ], $stock->toArray());
        })->all());

        return $stocks;
    }
}