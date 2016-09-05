<?php

/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/5/2016
 * Time: 10:20 PM
 */

use \Illuminate\Database\Seeder;
use \App\Role;

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        $role = [
            [
                'name' => 'r_admin',
                'display_name' => 'Administrator',
                'description' => 'Super User'
            ]
        ];
        foreach ($role as $key => $value) {
            Role::create($value);
        }
    }
}