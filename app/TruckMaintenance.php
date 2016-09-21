<?php

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

class TruckMaintenance extends Model
{
    protected $table = 'truck_maintenance';

    protected $fillable = [
        'truck_id', 'maintenance_type', 'cost', 'odometer', 'remarks'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function truck() {
        return $this->belongsTo('\App\Truck');
    }
}
