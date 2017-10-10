<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

/**
 * App\Model\SalesOrderCopy
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $customer_id
 * @property integer $warehouse_id
 * @property integer $vendor_trucking_id
 * @property integer $main_so_id
 * @property string $main_so_code
 * @property string $code
 * @property \Carbon\Carbon $so_created
 * @property string $so_type
 * @property \Carbon\Carbon $shipping_date
 * @property string $customer_type
 * @property string $walk_in_cust
 * @property string $walk_in_cust_detail
 * @property string $article_code
 * @property string $status
 * @property string $main_so_remarks
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Item[] $items
 * @property-read \App\Model\Customer $customer
 * @property-read \App\Model\Warehouse $warehouse
 * @property-read \App\Model\VendorTrucking $vendorTrucking
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereWarehouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereVendorTruckingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereMainSoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereMainSoCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereSoCreated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereSoType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereShippingDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereCustomerType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereWalkInCust($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereWalkInCustDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereArticleCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereMainSoRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrderCopy withoutTrashed()
 */
class SalesOrderCopy extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'so_created', 'shipping_date'];

    protected $table = 'sales_order_copies';

    protected $fillable = [
        'main_so_id',
        'main_so_code',
        'main_so_remarks',
        'store_id',
        'customer_id',
        'warehouse_id',
        'vendor_trucking_id',
        'code',
        'so_type',
        'so_created',
        'shipping_date',
        'customer_type',
        'walk_in_cust',
        'walk_in_cust_detail',
        'so_type',
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

    public function items()
    {
        return $this->morphMany('App\Model\Item', 'itemable');
    }

    public function customer()
    {
        return $this->belongsTo('App\Model\Customer', 'customer_id');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Model\Warehouse', 'warehouse_id');
    }

    public function vendorTrucking()
    {
        return $this->belongsTo('App\Model\VendorTrucking', 'vendor_trucking_id');
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
