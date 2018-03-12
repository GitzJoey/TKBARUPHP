<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 12:08 AM
 */

namespace App\Model;

use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Traits\StoreFilter;

/**
 * App\Model\Stock
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $po_id
 * @property integer $product_id
 * @property integer $warehouse_id
 * @property float $quantity
 * @property float $current_quantity
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Product $product
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Price[] $prices
 * @property-read \App\Model\Warehouse $warehouse
 * @property-read \App\Model\PurchaseOrder $purchaseOrder
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock wherePoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereWarehouseId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereCurrentQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock whereDeletedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Item[] $soItems
 * @property-read mixed $clean_quantity
 * @property-read mixed $clean_current_quantity
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\StockOpname[] $stockOpnames
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Stock withoutTrashed()
 * @property int $stock_merge_id
 * @property-read mixed $is_merge
 * @property-read \App\Model\StockMerge $stockMerge
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Stock whereStockMergeId($value)
 */
class Stock extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'stocks';

    protected $fillable = [
        'quantity',
        'current_quantity',
        'store_id',
        'po_id',
        'product_id',
        'warehouse_id'
    ];

    protected $appends = [
        'isMerge',
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function getIsMergeAttribute()
    {
        return $this->attributes['stock_merge_id'] == 0 ? false:true;
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Product', 'product_id');
    }

    public function prices()
    {
        return $this->hasMany('App\Model\Price');
    }

    public function stockOpnames()
    {
        return $this->hasMany('App\Model\StockOpname');
    }

    public function warehouse()
    {
        return $this->belongsTo('App\Model\Warehouse', 'warehouse_id');
    }

    public function stockMerge()
    {
        return $this->belongsTo('App\Model\StockMerge', 'stock_merge_id');
    }

    public function purchaseOrder()
    {
        return $this->belongsTo('App\Model\PurchaseOrder', 'po_id');
    }

    public function soItems()
    {
        return $this->hasMany('App\Model\Item')->where('itemable_type', 'App\\Model\\SalesOrder');
    }

    public function priceHistory($rangeOfDay = 10)
    {
        return Price::where('input_date', '>=', Carbon::today()->subDays($rangeOfDay))
            ->where('stock_id', '=', $this->id)
            ->orderBy('input_date', 'asc')
            ->orderBy('price_level_id', 'asc')->get();
    }

    public function getCleanQuantityAttribute()
    {
        return is_numeric( $this->quantity ) && floor( $this->quantity ) != $this->quantity ? $this->quantity : number_format($this->quantity, 0) ;
    }

    public function getCleanCurrentQuantityAttribute()
    {
        return is_numeric( $this->current_quantity ) && floor( $this->current_quantity ) != $this->current_quantity ? $this->current_quantity : number_format($this->current_quantity, 0) ;
    }

    public function latestPrices($priceLevelId = null)
    {
        if ($priceLevelId != null) {
            $listLatestPrices =
                Price::join(DB::raw("
                (
                    SELECT MAX(input_date) AS input_date	
                    FROM prices 
                    WHERE stock_id = $this->id
                ) max
            "), function($join)
                {
                    $join->on('prices.input_date', '=', 'max.input_date');
                })
                    ->where('stock_id', '=', $this->id)
                    ->where('price_level_id', '=', $priceLevelId)
                    ->orderBy('price_level_id')
                    ->get();
        } else {
            $listLatestPrices =
                Price::join(DB::raw("
                (
                    SELECT MAX(input_date) AS input_date	
                    FROM prices 
                    WHERE stock_id = $this->id
                ) max
            "), function($join)
                {
                    $join->on('prices.input_date', '=', 'max.input_date');
                })
                    ->where('stock_id', '=', $this->id)
                    ->orderBy('price_level_id')
                    ->get();
        }

        return $listLatestPrices;
    }

    public function todayPrices()
    {
        return Price::join(DB::raw("
            (
                SELECT MAX(input_date) AS max_input_date	
                FROM prices 
                WHERE stock_id = $this->id 
            ) max
        "), function($join)
        {
            $join->on('prices.input_date', '=', 'max.max_input_date');
        })
            ->where('stock_id', '=', $this->id)
            ->whereDate('input_date', '=', Carbon::today()->toDateString())
            ->orderBy('price_level_id')
            ->get();
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