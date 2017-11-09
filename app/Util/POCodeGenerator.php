<?php
/**
 * Created by PhpStorm.
 * User: miftah.fathudin
 * Date: 10/18/2016
 * Time: 3:11 AM
 */

namespace App\Util;

use Config;

use App\Model\PurchaseOrder;

/**
 * Class POCodeGenerator
 *
 * A utility class to generate a random alphanumeric string for PO code.
 *
 * @package App\Util
 */
class POCodeGenerator implements StringGenerator
{

    /**
     * @param $length number of the generated string
     * @return string generated string with specified length
     */
    public static function generateWithLength($length)
    {
        $generatedString = '';
        $characters = array_merge(Config::get('const.RANDOMSTRINGRANGE.ALPHABET'), Config::get('const.RANDOMSTRINGRANGE.NUMERIC'));
        $max = sizeof($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $generatedString .= $characters[mt_rand(0, $max)];
        }

        return strtoupper($generatedString);
    }

    public static function generateCode()
    {
        $result = '';

        do
        {
            $temp_result = self::generateWithLength(Config::get('const.TRXCODE.LENGTH'));
            $po = PurchaseOrder::whereCode($temp_result);
            if (empty($po->first())) {
                $result = $temp_result;
            }
        } while (empty($result));

        return $result;
    }
}