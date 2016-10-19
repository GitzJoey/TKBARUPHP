<?php
/**
 * Created by PhpStorm.
 * User: miftah.fathudin
 * Date: 10/18/2016
 * Time: 3:09 AM
 */

namespace App\Util;

/**
 * Interface StringGenerator
 *
 * Utility interface for genrating any kind of string.
 *
 * @package App\Util
 */
interface StringGenerator
{
    /**
     * @param $length the length of the generated string
     * @return string generated string with specified length
     */
    public static function generateWithLength($length);
}