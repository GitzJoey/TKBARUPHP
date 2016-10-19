<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/9/2016
 * Time: 11:50 PM
 */

namespace App;

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

    protected $fillable = [

    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function getItems(){
        return $this->belongsToMany('App\Items', 'po_items', 'po_id', 'items_id');
    }

    public function getPayments()
    {
        return $this->belongsToMany('App\Model\Payments', 'po_payments', 'po_id', 'payments_id');
    }

    public function getSupplier()
    {
        return $this->belongsTo('App\Supplier', 'supplier_id');
    }

    public function getTruckVendor()
    {
        return $this->belongsTo('App\VendorTrucking', 'vendor_trucking_id');
    }

    public function getStore()
    {
        return $this->belongsTo('App\Store', 'store_id');
    }

    public function getWarehouse()
    {
        return $this->belongsTo('App\Warehouse', 'warehouse_id');
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