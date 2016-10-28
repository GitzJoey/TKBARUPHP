<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/9/2016
 * Time: 11:50 PM
 */

namespace App\Model;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\PurchaseOrder
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $code
 * @property string $po_type
 * @property \Carbon\Carbon $po_created
 * @property \Carbon\Carbon $shipping_date
 * @property string $supplier_type
 * @property string $walk_in_supplier
 * @property string $walk_in_supplier_detail
 * @property string $remarks
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property integer $supplier_id
 * @property integer $vendor_trucking_id
 * @property integer $store_id
 * @property integer $warehouse_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Items[] $items
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Payments[] $payments
 * @property-read \App\Model\Supplier $supplier
 * @property-read \App\Model\VendorTrucking $vendorTrucking
 * @property-read \App\Model\Store $store
 * @property-read \App\Model\Warehouse $warehouse
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder wherePoType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder wherePoCreated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereShippingDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereSupplierType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereWalkInSupplier($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereWalkInSupplierDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereSupplierId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereVendorTruckingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrder whereWarehouseId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Receipt[] $receipts
 */
class PurchaseOrder extends Model
{
    use SoftDeletes;

    protected $table = 'purchase_orders';

    protected $dates = ['deleted_at', 'po_created', 'shipping_date'];

    protected $fillable = [
        'code', 'po_type', 'po_created', 'shipping_date',
        'supplier_type', 'walk_in_supplier', 'walk_in_supplier_detail',
        'remarks', 'status', 'supplier_id', 'vendor_trucking_id', 'warehouse_id',
        'store_id'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function items(){
        return $this->morphMany('App\Model\Item', 'itemable');
    }

    public function receipts(){
        return  $this->hasManyThrough('App\Model\Receipt', 'App\Model\Item', 'itemable_id', 'item_id', 'id');
    }

    public function payments()
    {
        return $this->belongsToMany('App\Model\Payment', 'purchase_order_payments', 'po_id', 'payment_id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Model\Supplier', 'supplier_id');
    }

    public function vendorTrucking()
    {
        return $this->belongsTo('App\Model\VendorTrucking', 'vendor_trucking_id');
    }

    public function store()
    {
        return $this->belongsTo('App\Model\Store', 'store_id');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Model\Warehouse', 'warehouse_id');
    }

    public function getIdAttribute($value){
        return HashIds::encode($value);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $user = Auth::user();
            if ($user) {
                $model->created_by = $user->id;
                $model->updated_by = $user->id;
            }
        });

        static::updating(function($model)
        {
            $user = Auth::user();
            if ($user) {
                $model->updated_by = $user->id;
            }
        });

        static::deleting(function($model)
        {
            $user = Auth::user();
            if ($user) {
                $model->deleted_by = $user->id;
                $model->save();
            }
        });
    }
}