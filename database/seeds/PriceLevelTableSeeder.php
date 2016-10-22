<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 10/20/2016
 * Time: 10:46 AM
 */

use App\Model\PriceLevel;

use Illuminate\Database\Seeder;

class PriceLevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pp = [
            [
                'store_id' => 1,
                'type' => 'PRICELEVELTYPE.inc',
                'weight' => 0,
                'name' => 'RETAIL',
                'description' => 'Retail / Eceran',
                'increment_value' => 200,
                'percentage_value' => 0,
                'status' => 'STATUS.Active',
            ],
            [
                'store_id' => 1,
                'type' => 'PRICELEVELTYPE.inc',
                'weight' => 1,
                'name' => 'WHOLESALE 1',
                'description' => 'Wholesale / Grosir Type 1',
                'increment_value' => 100,
                'percentage_value' => 0,
                'status' => 'STATUS.Active',
            ],
            [
                'store_id' => 1,
                'type' => 'PRICELEVELTYPE.inc',
                'weight' => 2,
                'name' => 'WHOLESALE 2',
                'description' => 'Wholesale / Grosir Type 2',
                'increment_value' => 50,
                'percentage_value' => 0,
                'status' => 'STATUS.Active',
            ],
        ];

        foreach ($pp as $key => $value) {
            PriceLevel::create($value);
        }
    }
}