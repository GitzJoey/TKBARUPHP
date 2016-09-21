<?php

/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/6/2016
 * Time: 1:29 AM
 */

use \Illuminate\Database\Seeder;
use \App\Settings;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            [
                'user_id' => 0,
                'category' => 'DUMMY',
                'skey' => 'DUMMY.setting_dummy',
                'value' => '1',
                'description' => 'Dummy Settings'
            ]
        ];
        foreach ($settings as $key => $value) {
            Settings::create($value);
        }

    }
}