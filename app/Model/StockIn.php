<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

/**
 * App\Model\StockIn
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $po_id
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
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn wherePoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereStockId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereWarehouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereDeletedAt($value)
 * @mixin \Eloquent
 * @property int $stock_opname_id
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereStockOpnameId($value)
 * @property int $stock_trf_id
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn whereStockTrfId($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockIn withoutTrashed()
 * @property int $stock_merge_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockIn whereStockMergeId($value)
 */
class StockIn extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'stock_ins';

    protected $fillable = [
        'quantity',
        'store_id',
        'po_id',
        'product_id',
        'warehouse_id',
        'stock_id',
        'stock_merge_id',
        'stock_opname_id',
        'stock_trf_id',
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
