<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 11/24/2016
 * Time: 2:04 PM
 */

namespace App\Services\Implementation;

use App\User;
use App\Model\Setting;

use App\Services\SettingService;

use Auth;

class SettingServiceImpl implements SettingService
{
    public function generateDefaultSettingsIfNotExists($id)
    {
        if (count(Auth::user()->settings) == 0) {
            $settingLists = [
                [
                    'user_id'       => $id,
                    'skey'          => 'pagination',
                    'value'         => '10',
                ],
                [
                    'user_id'       => $id,
                    'skey'          => 'fav.po_warehouse_id',
                    'value'         => '1',
                ],
                [
                    'user_id'       => $id,
                    'skey'          => 'fav.so_warehouse_id',
                    'value'         => '1',
                ],
            ];

            $user = User::whereId($id)->first();

            foreach ($settingLists as $key => $value) {
                $s = new Setting();
                $s->skey = $value['skey'];
                $s->value = $value['value'];

                $user->settings()->save($s);
            }
        }
    }
}