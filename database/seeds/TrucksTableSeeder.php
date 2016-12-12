<?php

use App\Model\Lookup;
use App\Model\Truck;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TrucksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $truckTypes = Lookup::where('category', '=', 'TRUCKTYPE')->get(['code']);

        foreach ($truckTypes as $key => $truckType){
            $truck = [
                'store_id' => 1,
                'type' => $truckType->code,
                'plate_number' => "B 100$key AG",
                'inspection_date' => Carbon::yesterday(),
                'driver' => "Driver $key",
                'status' => 'STATUS.ACTIVE',
                'remarks' => "Dummy truck $key"
            ];

            Truck::create($truck);
        }
    }
}
