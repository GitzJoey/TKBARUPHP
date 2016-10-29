<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/9/2016
 * Time: 11:50 PM
 */

namespace App\Model;

use Auth;
use Carbon\Carbon;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\SalesOrder
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $store_id
 * @property integer $customer_id
 * @property integer $vendor_truck_id
 * @property string $code
 * @property string $so_created
 * @property string $shipping_date
 * @property string $customer_type
 * @property string $walk_in_cust_detail
 * @property string $so_type
 * @property string $status
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereCustomerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereVendorTruckId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereSoCreated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereShippingDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereCustomerType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereWalkInCustDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereSoType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\SalesOrder whereDeletedAt($value)
 * @property string $walk_in_cust
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrder whereWalkInCust($value)
 * @property integer $warehouse_id
 * @method static \Illuminate\Database\Query\Builder|\App\Model\SalesOrder whereWarehouseId($value)
 */
class SalesOrder extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'sales_orders';

    protected $fillable = [
        'store_id',
        'customer_id',
        'vendor_truck_id',
        'code',
        'so_created',
        'shipping_date',
        'customer_type',
        'walk_in_cust_detail',
        'so_type',
        'status',
        'remarks'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
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