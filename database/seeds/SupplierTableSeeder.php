<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ba = [
          'bank_id' => 1,
          'account_number' => '1234567890'
        ];

        $supplier = [
            'name' => 'Miftah Fathudin',
            'address' => 'Jl. TMP Taruna no.74',
            'city' => 'Tangerang',
            'phone_number' => '12345678',
            'fax_num' => '0987654321',
            'tax_id' => '123-123-123-123-123'
        ];


    }
}
