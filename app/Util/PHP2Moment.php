<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 11/12/2017
 * Time: 11:17 AM
 */

namespace App\Util;

/**
 * Class PHP2Moment
 *
 * A utility class to convert PHP DateTime Format to Moment.js Format
 *
 * @package App\Util
 */
class PHP2Moment
{
    public static function convertToMoment($format)
    {
        $replacements = [
            'd' => 'DD',
            'D' => 'ddd',
            'j' => 'D',
            'l' => 'dddd',
            'N' => 'E',
            'S' => 'o',
            'w' => 'e',
            'z' => 'DDD',
            'W' => 'W',
            'F' => 'MMMM',
            'm' => 'MM',
            'M' => 'MMM',
            'n' => 'M',
            't' => '', // no equivalent
            'L' => '', // no equivalent
            'o' => 'YYYY',
            'Y' => 'YYYY',
            'y' => 'YY',
            'a' => 'a',
            'A' => 'A',
            'B' => '', // no equivalent
            'g' => 'h',
            'G' => 'H',
            'h' => 'hh',
            'H' => 'HH',
            'i' => 'mm',
            's' => 'ss',
            'u' => 'SSS',
            'e' => 'zz', // deprecated since version 1.6.0 of moment.js
            'I' => '', // no equivalent
            'O' => '', // no equivalent
            'P' => '', // no equivalent
            'T' => '', // no equivalent
            'Z' => '', // no equivalent
            'c' => '', // no equivalent
            'r' => '', // no equivalent
            'U' => 'X',
        ];

        $momentFormat = strtr($format, $replacements);
        return $momentFormat;
    }

    public static function convertToPHPDate($format)
    {
        $replacements = [
            'DD' => 'd',
            'ddd' => 'D',
            'D' => 'j',
            'dddd' => 'l',
            'E' => 'N',
            'o' => 'S',
            'e' => 'w',
            'DDD' => 'z',
            'W' => 'W',
            'MMMM' => 'F',
            'MM' => 'm',
            'MMM' => 'M',
            'M' => 'n',
            'YYYY' => 'o',
            'YYYY' => 'Y',
            'YY' => 'y',
            'a' => 'a',
            'A' => 'A',
            'h' => 'g',
            'H' => 'G',
            'hh' => 'h',
            'HH' => 'H',
            'mm' => 'i',
            'ss' => 's',
            'SSS' => 'u',
            'zz' => 'e',
            'X' => 'U',
        ];

        $phpFormat = strtr($format, $replacements);
        return $phpFormat;
    }
}