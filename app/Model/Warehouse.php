<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/21/2016
 * Time: 4:36 PM
 */

namespace App\Model;

use Auth;
use App\Traits\StoreFilter;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Warehouse
 *
 * @property integer $id
 * @property integer $store_id
 * @property string $name
 * @property string $address
 * @property string $phone_num
 * @property string $status
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read mixed $hid
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PurchaseOrder[] $purchaseOrders
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\WarehouseSection[] $sections
 * @property-read \App\Model\Store $store
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse wherePhoneNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Warehouse withoutTrashed()
 * @property-read mixed $h_id
 */
class Warehouse extends Model
{
    use SoftDeletes;

    use StoreFilter;

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

    public function purchaseOrders()
    {
        return $this->hasMany('App\Model\PurchaseOrder');
    }

    public function sections()
    {
        return $this->hasMany('App\Model\WarehouseSection');
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