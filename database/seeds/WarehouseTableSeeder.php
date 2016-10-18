<?php

use Illuminate\Database\Seeder;
use App\Warehouse;

class WarehouseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warehouses = [
          [
              'store_id' => 1,
              'name' => 'Gudang Utama',
              'address' => 'Jl. TMP Taruna no. 74',
              'status' => 'Active',
              'phone_number' => '085883227507'
          ]
        ];

        foreach ($warehouses as $key => $value) {
            Warehouse::create($value);
        }
    }
}
