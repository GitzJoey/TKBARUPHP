<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 10/19/2016
 * Time: 1:51 PM
 */

namespace App\Util;

use Config;

class SOCodeGenerator implements StringGenerator
{

    /**
     * @param $length number of the generated string
     * @return string generated string with specified length
     */
    public static function generateWithLength($length)
    {
        $generatedString = '';
        $characters = array_merge(Config::get('constants.RANDOMSTRINGRANGE.ALPHABET'), Config::get('constants.RANDOMSTRINGRANGE.NUMERIC'));
        $max = sizeof($characters) - 1;

        for ($i = 0; $i < $length; $i++) {
            $generatedString .= $characters[mt_rand(0, $max)];
        }

        return strtoupper($generatedString);
    }
}