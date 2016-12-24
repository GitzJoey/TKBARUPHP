<?php

use App\Model\Lookup;
use App\Model\Truck;
use App\Model\TruckMaintenance;
use Illuminate\Database\Seeder;

class TruckMaintenancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $trucks = Truck::all();
        $maintenanceTypes = Lookup::where('category', '=', 'TRUCKMTCTYPE')->get(['code']);

        for ($i = 1; $i < 11; $i++) {
            foreach ($trucks as $key => $truck){
                foreach ($maintenanceTypes as $key => $maintenanceType){
                    $truckMaintenance = [
                        'store_id' => 1,
                        'truck_id' => $truck->id,
                        'maintenance_type' => $maintenanceType->code,
                        'cost' => mt_rand(100000, 10000000),
                        'odometer' => mt_rand(3000, 10000000),
                        'remarks' => "Dummy maintenance ".$i
                    ];

                    TruckMaintenance::create($truckMaintenance);
                }
            }
        }
    }
}
