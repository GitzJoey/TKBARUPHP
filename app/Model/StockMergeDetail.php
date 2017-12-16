<?php

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\StockMergeDetail
 *
 * @property int $id
 * @property int $stock_merger_id
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
 */
class StockMergeDetail extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'stock_merge_details';

    protected $fillable = [
        'stock_merger_id',
        'po_id',
        'before_merge_qty',
        'po_price',
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
        return $this->belongsTo('App\Model\StockMerge', 'stock_merger_id');
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
