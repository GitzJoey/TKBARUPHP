<?php

/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/6/2016
 * Time: 1:29 AM
 */

use Illuminate\Database\Seeder;

use App\Model\Setting;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'user_id' => 0,
                'skey' => 'DATE.DATE_FORMAT',
                'value' => 'dd-MM-yyyy',
            ],
            [
                'user_id' => 0,
                'skey' => 'TIME.TIME_FORMAT',
                'value' => 'hh:mm',
            ],
            [
                'user_id' => 0,
                'skey' => 'TIME.24HOUR',
                'value' => '1',
            ],
            [
                'user_id' => 0,
                'skey' => 'MONEY.THOUSAND_SEPARATOR',
                'value' => ',',
            ],
            [
                'user_id' => 0,
                'skey' => 'MONEY.DECIMAL_DIGIT',
                'value' => '2',
            ]
        ];
        foreach ($settings as $key => $value) {
            Setting::create($value);
        }

    }
}