<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 11/22/2016
 * Time: 1:54 PM
 */

namespace App\Model;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseSection extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'warehouse_sections';

    protected $fillable = [
        'warehouse_id',
        'store_id',
        'name',
        'position',
        'capacity',
        'capacity_unit_id',
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

    protected $appends = [
        'hid'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function getHidAttribute()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function purchaseOrders()
    {
        return $this->hasMany('App\Model\PurchaseOrder');
    }

    public function warehouse()
    {
        $this->belongsTo('App\Model\Warehouse');
    }

    public function capacityUnit()
    {
        return $this->belongsTo('App\Model\Unit', 'capacity_unit_id');
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