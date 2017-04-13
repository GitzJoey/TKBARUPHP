<?php
/**
 * Created by PhpStorm.
 * User: Rudy Setiady
 * Date: 04/07/2017
 * Time: 05:04 PM
 */

namespace App\Services;

use Doctrine\Common\Collections\Collection;
use Illuminate\Http\Request;

interface StockTransferService
{
    public function transfer(Request $request);
}