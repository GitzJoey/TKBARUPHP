<?php
/**
 * Created by PhpStorm.
 * User: Rudy Setiady
 * Date: 04/07/2017
 * Time: 05:04 PM
 */

namespace App\Services;

use Doctrine\Common\Collections\Collection;

interface StockTransferService
{
    public function transferStock(Request $request);
}