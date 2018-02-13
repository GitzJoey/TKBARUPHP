<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 12/16/2016
 * Time: 8:19 AM
 */

namespace App\Services\Implementation;

use File;
use Storage;
use Carbon\Carbon;
use App\Services\ReportService;

class ReportServiceImpl implements ReportService
{
    public function doReportHousekeeping()
    {
        foreach (Storage::disk('report_storage')->files() as $filename) {
            $processFile = storage_path("app/public/reports/").$filename;

            if (Carbon::createFromFormat('U', File::lastModified($processFile))->diffInDays(Carbon::now()) > 0) {
                File::delete($processFile);
            }
        }
    }

    public function getTodayPriceList(
        $productCategories, $priceLevels, $selectedPriceLevel = null, $selectedDate = null)
    {
        $result = [];

        foreach ($productCategories as $pc) {
            foreach ($pc->stocks as $stock) {
                foreach ($stock->latestPrices() as $price) {
                    if ($selectedPriceLevel != null) {
                        if ($price->price_level_id != $selectedPriceLevel) continue;

                        array_push($result, [
                            'product_category_name' => $pc->name,
                            'product_name' => $stock->product->name,
                            'price' => $price->priceLevel->name.' - '.$price->price
                        ]);
                    } else {
                        array_push($result, [
                            'product_category_name' => $pc->name,
                            'product_name' => $stock->product->name,
                            'price' => $price->priceLevel->name.' - '.$price->price
                        ]);
                    }
                }
            }
        }

        return $result;
    }

    public function getStockList($stockList)
    {
        $result = [];

        foreach($stockList as $s) {
            if ($s['current_quantity'] > 0) {
                array_push($result, [
                    'warehouse' => $s['warehouse']['name'],
                    'product_type' => $s['product']['type']['name'],
                    'product' => $s['product']['name'],
                    'quantity' => $s['current_quantity']
                ]);
            }
        }

        return $result;
    }
};