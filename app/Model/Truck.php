<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:17 AM
 */

namespace App\Model;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Truck
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $plate_number
 * @property string $inspection_date
 * @property string $driver
 * @property string $status
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck wherePlateNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereInspectionDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereDriver($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\TruckMaintenance[] $maintenanceList
 * @property integer $store_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Truck whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TruckMaintenance[] $truckMaintenances
 */
class Truck extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'trucks';

    protected $fillable = [
        'store_id',
        'plate_number',
        'inspection_date',
        'driver',
        'status',
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

    public function truckMaintenances()
    {
        return $this->hasMany('App\Model\TruckMaintenance');
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