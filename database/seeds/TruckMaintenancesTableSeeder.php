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


        foreach ($trucks as $key => $truck){
            foreach ($maintenanceTypes as $key => $maintenanceType){
                $truckMaintenance = [
                    'store_id' => 1,
                    'truck_id' => $truck->id,
                    'maintenance_type' => $maintenanceType->code,
                    'cost' => 100000.00,
                    'odometer' => 3000,
                    'remarks' => "Dummy maintenance"
                ];

                TruckMaintenance::create($truckMaintenance);
            }
        }
    }
}
