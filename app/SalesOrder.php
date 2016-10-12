<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/9/2016
 * Time: 11:50 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\SalesOrder
 *
 * @mixin \Eloquent
 */
class SalesOrder extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'sales_order';

    protected $fillable = [
        'store_id', 'customer_id', 'vendor_truck_id', 'code', 'so_created', 'shipping_date', 'customer_type', 'walk_in_cust_detail', 'so_type', 'status', 'remarks'
    ];


    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $user = Auth::user();
            $model->created_by = $user->id;
            $model->updated_by = $user->id;
        });

        static::updating(function($model)
        {
            $user = Auth::user();
            $model->updated_by = $user->id;
        });

        static::deleting(function($model)
        {
            $user = Auth::user();
            $model->deleted_by = $user->id;
            $model->save();
        });
    }
}