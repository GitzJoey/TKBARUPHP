<?php

namespace App\Model;

use Auth;
use Carbon\Carbon;
use App\Traits\StoreFilter;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockTransfer extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'stock_transfers';

    protected $fillable = [
        'quantity',
        'cost',
        'reason',
        'store_id',
        'po_id',
        'product_id',
        'transfer_date',
        'source_warehouse_id',
        'destination_warehouse_id'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Product', 'product_id');
    }

    public function prices()
    {
        return $this->hasMany('App\Model\Price');
    }

    public function source_warehouse()
    {
        return $this->belongsTo('App\Model\Warehouse', 'source_warehouse_id');
    }

    public function destination_warehouse()
    {
        return $this->belongsTo('App\Model\Warehouse', 'destination_warehouse_id');
    }

    public function purchaseOrder()
    {
        return $this->belongsTo('App\Model\PurchaseOrder', 'po_id');
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
