<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/21/2016
 * Time: 4:36 PM
 */

namespace App\Model;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Warehouse
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone_num
 * @property string $status
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse wherePhoneNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $store_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Warehouse whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PurchaseOrder[] $purchaseOrders
 * @property-read mixed $hid
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\WarehouseSection[] $sections
 */
class Warehouse extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'warehouses';

    protected $fillable = [
        'store_id',
        'name',
        'address',
        'phone_num',
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

    public function sections()
    {
        return $this->hasMany('App\Model\WarehouseSection');
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