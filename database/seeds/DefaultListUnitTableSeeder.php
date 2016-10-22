<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/9/2016
 * Time: 11:35 PM
 */

use Illuminate\Database\Seeder;

use App\Model\Unit;

class DefaultListUnitTableSeeder extends Seeder
{
    public function run()
    {
        $unit = [
            [
                'name'      => 'Kilogram',
                'symbol'    => 'Kg',
                'status'    => 'STATUS.Active',
                'remarks'   => ''
            ],
            [
                'name'      => 'Drum',
                'symbol'    => 'Dr',
                'status'    => 'STATUS.Active',
                'remarks'   => ''
            ],
            [
                'name'      => 'Tonne',
                'symbol'    => 'Tn',
                'status'    => 'STATUS.Active',
                'remarks'   => ''
            ],
            [
                'name'      => 'Zak',
                'symbol'    => 'z',
                'status'    => 'STATUS.Active',
                'remarks'   => ''
            ],
        ];
        foreach ($unit as $key => $value) {
            Unit::create($value);
        }
    }
}
