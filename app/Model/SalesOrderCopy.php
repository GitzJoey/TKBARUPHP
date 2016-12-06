<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

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
