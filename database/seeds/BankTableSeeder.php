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
        		'name' => 'Bank Mandiri',
        		'short_name' => 'Mandiri',
        		'branch' => 'Jakarta',
        		'branch_code' => 'M0321',
        		'status' => 'STATUS.Active',
        		'remarks' => 'Bank Mandiri'
        	],
        	[
        		'name' => 'Bank BCA',
        		'short_name' => 'BCA',
        		'branch' => 'Jakarta',
        		'branch_code' => 'B0235',
        		'status' => 'STATUS.Active',
        		'remarks' => 'Bank Central Asia'
        	],
        	[
        		'name' => 'Bank Permata',
        		'short_name' => 'PRMT',
        		'branch' => 'Jakarta',
        		'branch_code' => 'P0232',
        		'status' => 'STATUS.Active',
        		'remarks' => 'Bank Permata'
        	]
        ];
        foreach ($banks as $key => $value) {
            Bank::create($value);
        }
    }
}
