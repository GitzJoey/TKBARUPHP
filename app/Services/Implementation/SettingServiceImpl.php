<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 11/24/2016
 * Time: 2:04 PM
 */

namespace App\Services\Implementation;

use App\Model\Setting;

use App\Services\SettingService;

class SettingServiceImpl implements SettingService
{
    public function generateDefaultSettingsIfNotExists($id)
    {
        $result = [];

        $s1 = new Setting();
        $s1->skey = '';
        $s1->svalue = '';

        $s2 = new Setting();
        $s2->skey = '';
        $s2->svalue = '';

        $s3 = new Setting();
        $s3->skey = '';
        $s3->svalue = '';

        $s4 = new Setting();
        $s4->skey = '';
        $s4->svalue = '';

        $s5 = new Setting();
        $s5->skey = '';
        $s5->svalue = '';

        $s6 = new Setting();
        $s6->skey = '';
        $s6->svalue = '';

        $s7 = new Setting();
        $s7->skey = '';
        $s7->svalue = '';

        $s8 = new Setting();
        $s8->skey = '';
        $s8->svalue = '';

        array_push($result, $s1);
        array_push($result, $s2);
        array_push($result, $s3);
        array_push($result, $s4);
        array_push($result, $s5);
        array_push($result, $s6);
        array_push($result, $s7);
        array_push($result, $s8);

        return $result;
    }
}