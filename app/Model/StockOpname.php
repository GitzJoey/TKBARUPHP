<?php

namespace App\Model;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Vinkla\Hashids\Facades\Hashids;

use App\Traits\StoreFilter;

/**
 * App\Model\StockOpname
 *
 * @property integer $id
 * @property integer $stock_id
 * @property string $opname_date
 * @property boolean $is_match
 * @property float $previous_quantity
 * @property float $adjusted_quantity
 * @property string $reason
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\StockIn $stockIn
 * @property-read \App\Model\StockOut $stockOut
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname whereStockId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname whereOpnameDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname whereIsMatch($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname wherePreviousQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname whereAdjustedQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname whereReason($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname whereDeletedAt($value)
 * @mixin \Eloquent
 * @property-read \App\Model\Stock $stock
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockOpname withoutTrashed()
 * @property int $store_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockOpname whereStoreId($value)
 */
class StockOpname extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'stock_opnames';

    protected $fillable = [
        'stock_id',
        'store_id',
        'opname_date',
        'is_match',
        'previous_quantity',
        'adjusted_quantity',
        'reason'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function stock()
    {
        return $this->belongsTo('App\Model\Stock');
    }

    public function stockIn()
    {
        return $this->hasOne('App\Model\StockIn');
    }

    public function stockOut()
    {
        return $this->hasOne('App\Model\StockOut');
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
