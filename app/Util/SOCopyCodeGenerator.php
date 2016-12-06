<?php
/**
 * Created by PhpStorm.
 * User: MILIMURIDAM
 * Date: 12/3/2016
 * Time: 8:08 PM
 */

namespace App\Util;


use App\Model\SalesOrderCopy;

class SOCopyCodeGenerator
{
    public static function generateCode($soCode)
    {
        $lastCode = SalesOrderCopy::withTrashed()->where('main_so_code', '=', $soCode)->max('code');

        // if there is no sales order copy yet
        if(is_null($lastCode))
        {
            return $soCode . '01';
        }
        else{
            $nextSequence = intval(substr($lastCode, 6));
            $nextSequence += 1;
            $nextSequence = sprintf('%02d', $nextSequence);
            return $soCode . $nextSequence;
        }
    }
}