<?php

use Illuminate\Database\Seeder;

use App\Model\Currencies;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            [
                'name'          => 'Indonesian Rupiah',
                'Symbol'        => 'Rp',
                'status'        => 'STATUS.ACTIVE',
                'remarks'       => ''
            ],
            [
                'name'          => 'American Dollar',
                'Symbol'        => '$',
                'status'        => 'STATUS.ACTIVE',
                'remarks'       => ''
            ]
        ];
        foreach ($currencies as $key => $value) {
            Currencies::create($value);
        }

    }
}
