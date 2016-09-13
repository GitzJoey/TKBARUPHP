<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/9/2016
 * Time: 11:35 PM
 */

use \Illuminate\Database\Seeder;
use App\Unit;

class DefaultUnitTableSeeder extends Seeder
{
    public function run()
    {
        $unit = [
            [
                'unit_name' => 'Kilogram',
                'symbol' => 'Kg',


            ],
        ];
        foreach ($unit as $key => $value) {
            Unit::create($value);
        }
    }
}
