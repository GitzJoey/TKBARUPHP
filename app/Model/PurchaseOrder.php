<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/9/2016
 * Time: 11:50 PM
 */

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\PurchaseOrder
 *
 * @mixin \Eloquent
 */
class PurchaseOrder extends Model
{
    use SoftDeletes;

    protected $table = 'purchase_order';

    protected $dates = ['deleted_at', 'po_created', 'shipping_date'];

    protected $fillable = [
        'code', 'po_type', 'po_created', 'shipping_date', 'supplier_type', 'walk_in_supplier', 'walk_in_supplier_detail', 'remarks', 'status'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function items(){
        return $this->belongsToMany('App\Model\Items', 'po_items', 'po_id', 'items_id');
    }

    public function payments()
    {
        return $this->belongsToMany('App\Model\Payments', 'po_payments', 'po_id', 'payments_id');
    }

    public function suppliers()
    {
        return $this->belongsTo('App\Model\Supplier', 'supplier_id');
    }

    public function truckVendor()
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