<?php

/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 11:11 AM
 */
use \Illuminate\Database\Seeder;
use App\PhoneProvider;

class PhoneProviderTableSeeder extends Seeder
{
    public function run()
    {
        $phoneprovider = [
            [
                'name' => 'Telkomsel',
                'short_name' => 'T-SEL',
                'status' => 'STATUS.Active',
                'remarks' => ''
            ],
            [
                'name' => 'XL',
                'short_name' => 'XL',
                'status' => 'STATUS.Active',
                'remarks' => ''
            ],
            [
                'name' => 'Indosat',
                'short_name' => 'ISAT',
                'status' => 'STATUS.Active',
                'remarks' => ''
            ],
            [
                'name' => 'Tri',
                'short_name' => '3',
                'status' => 'STATUS.Active',
                'remarks' => ''
            ],
            [
                'name' => 'Telkom',
                'short_name' => 'TLKM',
                'status' => 'STATUS.Active',
                'remarks' => ''
            ],
        ];
        foreach ($phoneprovider as $key => $value) {
            PhoneProvider::create($value);
        }
    }
}