<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

/**
 * App\Model\StockOut
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $so_id
 * @property integer $product_id
 * @property integer $stock_id
 * @property integer $warehouse_id
 * @property float $quantity
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\StockOpname $stockOpname
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereSoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereStockId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereWarehouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereDeletedAt($value)
 * @mixin \Eloquent
 * @property int $stock_opname_id
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereStockOpnameId($value)
 * @property int $stock_trf_id
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut whereStockTrfId($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOut withoutTrashed()
 */
class StockOut extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'stock_outs';

    protected $fillable = [
        'quantity',
        'store_id',
        'so_id',
        'product_id',
        'warehouse_id',
        'stock_id',
        'stock_opname_id'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function stockOpname()
    {
        return $this->belongsTo('App\Model\StockOpname');
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
