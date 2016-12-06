<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 12/3/2016
 * Time: 7:32 PM
 */

namespace App\Util;


use App\Model\PurchaseOrderCopy;

class POCopyCodeGenerator
{
    public static function generateCode($poCode)
    {
        $lastCode = PurchaseOrderCopy::withTrashed()->where('main_po_code', '=', $poCode)->max('code');

        // if there is no purchase order copy yet
        if(is_null($lastCode))
        {
            return $poCode . '01';
        }
        else{
            $nextSequence = intval(substr($lastCode, 6));
            $nextSequence += 1;
            $nextSequence = sprintf('%02d', $nextSequence);
            return $poCode . $nextSequence;
        }
    }
}