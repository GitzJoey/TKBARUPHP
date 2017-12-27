<?php

namespace App\Model;

use Auth;
use Carbon\Carbon;
use App\Traits\StoreFilter;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\StockTransfer
 *
 * @property int $id
 * @property int $store_id
 * @property int $po_id
 * @property int $product_id
 * @property string $transfer_date
 * @property int $source_warehouse_id
 * @property int $destination_warehouse_id
 * @property float $quantity
 * @property float $cost
 * @property string $reason
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Product $product
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Price[] $prices
 * @property-read \App\Model\Warehouse $source_warehouse
 * @property-read \App\Model\Warehouse $destination_warehouse
 * @property-read \App\Model\PurchaseOrder $purchaseOrder
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer wherePoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer whereTransferDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer whereSourceWarehouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer whereDestinationWarehouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer whereCost($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockTransfer withoutTrashed()
 * @property int $stock_id
 * @property-read \App\Model\Stock $stock
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockTransfer whereStockId($value)
 */
class StockTransfer extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'stock_transfers';

    protected $fillable = [
        'store_id',
        'stock_id',
        'product_id',
        'source_warehouse_id',
        'destination_warehouse_id',
        'transfer_date',
        'quantity',
        'cost',
        'reason',
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

    public function stock()
    {
        return $this->belongsTo('App\Model\Stock', 'stock_id');
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
