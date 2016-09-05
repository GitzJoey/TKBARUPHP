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
                'name' => 'r_admin',
                'display_name' => 'Administrator',
                'description' => 'Super User'
            ]
        ];
        foreach ($settings as $key => $value) {
            Settings::create($value);
        }
    }
}