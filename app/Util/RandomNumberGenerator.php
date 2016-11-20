<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 11/20/2016
 * Time: 7:31 AM
 */

namespace App\Util;

class RandomNumberGenerator
{
    private static $RSeed = 0;

    public static function seed($s = 0)
    {
        self::$RSeed = abs(intval($s)) % 9999999 + 1;
        self::generateNumber();
    }

    public static function generateNumber($min = 0, $max = 9999999)
    {
        if (self::$RSeed == 0)
            self::seed(mt_rand());

        self::$RSeed = (self::$RSeed * 125) % 2796203;

        return self::$RSeed % ($max - $min + 1) + $min;
    }

    public static function generateOne($max = 0)
    {
        if ($max == 0) {
            return self::generateNumber(0, 9999999);
        } else {
            return self::generateNumber(0, $max);
        }
    }
}