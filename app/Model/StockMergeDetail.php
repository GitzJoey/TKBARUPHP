<?php

namespace App\Model;

use Auth;
use Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\StockMergeDetail
 *
 * @property int $id
 * @property int $stock_merge_id
 * @property int $po_id
 * @property float $before_merge_qty
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMergeDetail whereBeforeMergeQty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMergeDetail whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMergeDetail whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMergeDetail whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMergeDetail whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMergeDetail whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMergeDetail wherePoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMergeDetail whereStockMergerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMergeDetail whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMergeDetail whereUpdatedBy($value)
 * @mixin \Eloquent
 * @property int|null $merged_price
 * @property-read \App\Model\StockMerge $stockMerger
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockMergeDetail onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMergeDetail whereMergedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMergeDetail whereStockMergeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockMergeDetail withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockMergeDetail withoutTrashed()
 * @property float|null $before_merge_price
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMergeDetail whereBeforeMergePrice($value)
 */
class StockMergeDetail extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'stock_merge_details';

    protected $fillable = [
        'stock_merge_id',
        'po_id',
        'item_id',
        'before_merge_qty',
        'before_merge_price',
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

    public function stockMerger()
    {
        return $this->belongsTo('App\Model\StockMerge', 'stock_merge_id');
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
