<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 11/24/2016
 * Time: 12:48 AM
 */

namespace App\Services;


use Doctrine\Common\Collections\Collection;

interface StockService
{
    /**
     * Get all stocks with related data which meet sales requirement.
     *
     * @return Collection stocks ready to be sold.
     */
    public function getStocksForSO();
}