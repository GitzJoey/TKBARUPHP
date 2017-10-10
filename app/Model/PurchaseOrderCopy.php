<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

/**
 * App\Model\PurchaseOrderCopy
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $supplier_id
 * @property integer $warehouse_id
 * @property integer $vendor_trucking_id
 * @property integer $main_po_id
 * @property string $main_po_code
 * @property string $code
 * @property \Carbon\Carbon $po_created
 * @property string $po_type
 * @property \Carbon\Carbon $shipping_date
 * @property string $supplier_type
 * @property string $walk_in_supplier
 * @property string $walk_in_supplier_detail
 * @property string $article_code
 * @property string $main_po_remarks
 * @property string $remarks
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\PurchaseOrder $purchaseOrder
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Item[] $items
 * @property-read \App\Model\Supplier $supplier
 * @property-read \App\Model\Warehouse $warehouse
 * @property-read \App\Model\VendorTrucking $vendorTrucking
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereSupplierId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereWarehouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereVendorTruckingId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereMainPoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereMainPoCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy wherePoCreated($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy wherePoType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereShippingDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereSupplierType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereWalkInSupplier($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereWalkInSupplierDetail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereArticleCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereMainPoRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PurchaseOrderCopy withoutTrashed()
 */
class PurchaseOrderCopy extends Model
{
    use SoftDeletes;

    protected $table = 'purchase_order_copies';

    protected $fillable = [
        'main_po_id',
        'main_po_code',
        'main_po_remarks',
        'code',
        'po_type',
        'po_created',
        'shipping_date',
        'supplier_type',
        'walk_in_supplier',
        'walk_in_supplier_detail',
        'remarks',
        'status',
        'supplier_id',
        'vendor_trucking_id',
        'warehouse_id',
        'store_id'
    ];

    protected $dates = ['deleted_at', 'po_created', 'shipping_date'];

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

    public function purchaseOrder()
    {
        return $this->belongsTo('App\Model\PurchaseOrder');
    }

    public function items()
    {
        return $this->morphMany('App\Model\Item', 'itemable');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Model\Supplier', 'supplier_id');
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
