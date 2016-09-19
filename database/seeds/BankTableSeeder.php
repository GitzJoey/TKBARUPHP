<?php

use Illuminate\Database\Seeder;
use App\Bank;

class BankTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
        	[
        		'name' => 'Mandiri',
        		'short_name' => 'mandiri',
        		'branch' => 'Jakarta',
        		'branch_code' => 'M0321',
        		'status' => 'STATUS.Active',
        		'remarks' => ''
        	],
        	[
        		'name' => 'BCA',
        		'short_name' => 'bca',
        		'branch' => 'Jakarta',
        		'branch_code' => 'B0235',
        		'status' => 'STATUS.Active',
        		'remarks' => ''
        	],
        	[
        		'name' => 'Permata',
        		'short_name' => 'permata',
        		'branch' => 'Jakarta',
        		'branch_code' => 'P0232',
        		'status' => 'STATUS.Active',
        		'remarks' => ''
        	]
        ];
        foreach ($banks as $key => $value) {
            Bank::create($value);
        }
    }
}
