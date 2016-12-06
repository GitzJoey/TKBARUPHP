<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

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
