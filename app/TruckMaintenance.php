<?php

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

/**
 * App\TruckMaintenance
 *
 * @property integer $id
 * @property integer $truck_id
 * @property string $maintenance_type
 * @property integer $cost
 * @property integer $odometer
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Truck $truck
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereTruckId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereMaintenanceType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereCost($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereOdometer($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TruckMaintenance extends Model
{
    protected $table = 'truck_maintenance';

    protected $fillable = [
        'store_id', 'truck_id', 'maintenance_type', 'cost', 'odometer', 'remarks'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function truck() {
        return $this->belongsTo('\App\Truck');
    }
}
