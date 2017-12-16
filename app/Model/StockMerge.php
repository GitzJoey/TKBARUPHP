<?php

namespace App\Model;

use Auth;
use Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\StockMerge
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string|null $merge_type
 * @property string|null $merge_date
 * @property string|null $remarks
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \Carbon\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\StockMergeDetail[] $stockMergeDetails
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockMerge onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMerge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMerge whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMerge whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMerge whereDeletedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMerge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMerge whereMergeDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMerge whereMergeType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMerge whereRemarks($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMerge whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMerge whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockMerge withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\StockMerge withoutTrashed()
 * @property int|null $product_id
 * @property float|null $merged_price
 * @property-read \App\Model\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMerge whereMergedPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\StockMerge whereProductId($value)
 */
class StockMerge extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'stock_merger';

    protected $fillable = [
        'merge_type',
        'merge_date',
        'remarks',
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

    public function stockMergeDetails()
    {
        return $this->hasMany('App\Model\StockMergeDetail');
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Product', 'product_id');
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
