<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 12:07 AM
 */

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vinkla\Hashids\Facades\Hashids;

/**
 * App\Model\Item
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $product_id
 * @property integer $stock_id
 * @property integer $selected_unit_id
 * @property integer $base_unit_id
 * @property integer $itemable_id
 * @property string $itemable_type
 * @property float $conversion_value
 * @property float $quantity
 * @property float $price
 * @property float $to_base_quantity
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Product $product
 * @property-read \App\Model\ProductUnit $selectedUnit
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Receipt[] $receipts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Deliver[] $delivers
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $itemable
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereStockId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereSelectedUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereBaseUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereItemableId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereItemableType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereConversionValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereToBaseQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item whereDeletedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ItemDiscounts[] $discounts
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Item withoutTrashed()
 */
class Item extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'items';

    protected $fillable = [
        'quantity'
    ];

    protected $hidden = [
        'itemable_type'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Product', 'product_id');
    }

    public function selectedUnit()
    {
        return $this->belongsTo('App\Model\ProductUnit', 'selected_unit_id');
    }

    public function receipts()
    {
        return $this->hasMany('App\Model\Receipt');
    }

    public function delivers()
    {
        return $this->hasMany('App\Model\Deliver');
    }

    public function discounts()
    {
        return $this->morphMany('App\Model\ItemDiscounts', 'discountable');
    }

    public function itemable()
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
