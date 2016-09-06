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
                'category' => '',
                'skey' => '',
                'svalue' => '',
                'description' => ''
            ]
        ];
        foreach ($settings as $key => $value) {
            Settings::create($value);
        }
    }
}