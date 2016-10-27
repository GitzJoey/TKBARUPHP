<?php

/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 11:11 AM
 */
use Illuminate\Database\Seeder;

use App\Model\PhoneProvider;

class PhoneProviderTableSeeder extends Seeder
{
    public function run()
    {
        $phoneprovider = [
            [
                'name' => 'Telkomsel',
                'short_name' => 'T-SEL',
                'status' => 'STATUS.ACTIVE',
                'remarks' => ''
            ],
            [
                'name' => 'XL',
                'short_name' => 'XL',
                'status' => 'STATUS.ACTIVE',
                'remarks' => ''
            ],
            [
                'name' => 'Indosat',
                'short_name' => 'ISAT',
                'status' => 'STATUS.ACTIVE',
                'remarks' => ''
            ],
            [
                'name' => 'Tri',
                'short_name' => '3',
                'status' => 'STATUS.ACTIVE',
                'remarks' => ''
            ],
            [
                'name' => 'Telkom',
                'short_name' => 'TLKM',
                'status' => 'STATUS.ACTIVE',
                'remarks' => ''
            ],
        ];
        foreach ($phoneprovider as $key => $value) {
            PhoneProvider::create($value);
        }
    }
}