<?php

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemDiscounts extends Model
{
    use SoftDeletes;
	
    protected $dates = ['deleted_at'];
	
    protected $fillable = [
        'discountable_id',
        'discountable_type',
        'item_disc_percent',
        'item_disc_value'
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function discountable()
    {
        // SalesOrder | SalesOrderCopy | PurchaseOrder | PurchaseOrderCopy
        return $this->morphTo();
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
