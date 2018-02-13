<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 12/16/2016
 * Time: 8:18 AM
 */

namespace App\Services;

interface ReportService
{
    public function doReportHousekeeping();

    //Price Report
    public function getTodayPriceList(
        $productCategories, $priceLevels, $selectedPriceLevel = null, $selectedDate = null);

    public function getStockList($stockList);
}