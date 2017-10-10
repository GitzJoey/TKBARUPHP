<?php

namespace App\Model;

use Auth;
use App\Traits\StoreFilter;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property integer $store_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\TruckMaintenance whereDeletedAt($value)
 * @property-read \App\Model\Store $store
 * @property string $maintenance_date
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TruckMaintenance whereMaintenanceDate($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TruckMaintenance onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TruckMaintenance withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\TruckMaintenance withoutTrashed()
 */
class TruckMaintenance extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['maintenance_date', 'deleted_at'];

    protected $table = 'truck_maintenances';

    protected $fillable = [
        'store_id',
        'truck_id',
        'maintenance_date',
        'maintenance_type',
        'cost',
        'odometer',
        'remarks'
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function truck()
    {
        return $this->belongsTo('App\Model\Truck');
    }
    public function store()
    {
        return $this->belongsTo('App\Model\Store');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $user = Auth::user();
            if ($user) {
                $model->created_by = $user->id;
                $model->updated_by = $user->id;
            }
        });

        static::updating(function ($model) {
            $user = Auth::user();
            if ($user) {
                $model->updated_by = $user->id;
            }
        });

        static::deleting(function ($model) {
            $user = Auth::user();
            if ($user) {
                $model->deleted_by = $user->id;
                $model->save();
            }
        });
    }
}
