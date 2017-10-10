<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 11/22/2016
 * Time: 1:54 PM
 */

namespace App\Model;

use Auth;
use App\Traits\StoreFilter;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\WarehouseSection
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $warehouse_id
 * @property string $name
 * @property string $position
 * @property integer $capacity
 * @property integer $capacity_unit_id
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read mixed $hid
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PurchaseOrder[] $purchaseOrders
 * @property-read \App\Model\Unit $capacityUnit
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereWarehouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection wherePosition($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereCapacity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereCapacityUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\WarehouseSection withoutTrashed()
 */
class WarehouseSection extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'warehouse_sections';

    protected $fillable = [
        'warehouse_id',
        'store_id',
        'name',
        'position',
        'capacity',
        'capacity_unit_id',
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
        'hid'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function getHidAttribute()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function purchaseOrders()
    {
        return $this->hasMany('App\Model\PurchaseOrder');
    }

    public function warehouse()
    {
        $this->belongsTo('App\Model\Warehouse');
    }

    public function capacityUnit()
    {
        return $this->belongsTo('App\Model\Unit', 'capacity_unit_id');
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