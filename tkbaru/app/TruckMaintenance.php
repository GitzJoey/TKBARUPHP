<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TruckMaintenance extends Model
{
    protected $table = 'truck_maintenance';

    protected $fillable = [
        'truck_id', 'maintenance_type', 'cost', 'odometer', 'remarks'
    ];

    public function truck() {
        return $this->belongsTo('\App\Truck');
    }
}
