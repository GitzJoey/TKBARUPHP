<?php

/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 1:16 PM
 */

use \Illuminate\Database\Seeder;
use \App\Lookup;

class CreateLookupTableSeeder extends Seeder
{
    public function run()
    {
        $lookup = [
            [
                'code' => 'STATUS.Active',
                'description' => 'Active',
                'category' => 'STATUS',
            ],
            [
                'code' => 'STATUS.Inctive',
                'description' => 'Inactive',
                'category' => 'STATUS',
            ],
            [
                'code' => 'YESNOSELECT.Yes',
                'description' => 'Yes',
                'category' => 'YESNOSELECT',
            ],
            [
                'code' => 'YESNOSELECT.No',
                'description' => 'No',
                'category' => 'YESNOSELECT',
            ],
        ];
        foreach ($lookup as $key => $value) {
            Lookup::create($value);
        }
    }
}