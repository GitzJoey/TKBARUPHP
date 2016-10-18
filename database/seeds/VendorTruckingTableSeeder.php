<?php

use Illuminate\Database\Seeder;
use App\VendorTrucking;

class VendorTruckingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vts = [
          [
              'store_id' => 1,
              'name' => 'Vendor1',
              'address' => 'Jl. Ahmad Yani no. 17',
              'tax_id' => '123-123-123-123',
              'status' => 'Active'
          ]
        ];

        foreach ($vts as $key => $value) {
            VendorTrucking::create($value);
        }
    }
}
