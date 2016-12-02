<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 12/1/2016
 * Time: 10:45 PM
 */

namespace App\Services;

use Illuminate\Http\Request;

interface InflowService
{
    /**
     * Receipt items in a purchase order.
     *
     * @param Request $request request conatining data from receipt form.
     * @param int $poId id of purchase order which item(s) to be received.
     * @return void
     */
    public function createPOReceipt(Request $request, $poId);
}