<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:17 AM
 */

namespace App\Model;

use Auth;
use App\Traits\StoreFilter;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Truck
 *
 * @property integer $id
 * @property integer $store_id
 * @property string $type
 * @property string $plate_number
 * @property string $inspection_date
 * @property string $driver
 * @property string $status
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Store $store
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\TruckMaintenance[] $truckMaintenances
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck wherePlateNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck whereInspectionDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck whereDriver($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Truck withoutTrashed()
 * @property-read mixed $h_id
 */
class Truck extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'trucks';

    protected $fillable = [
        'store_id',
        'type',
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

    protected $appends = [
        'hId'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function getHIdAttribute()
    {
        return $this->hId();
    }

    public function store()
    {
        return $this->belongsTo('App\Model\Store');
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