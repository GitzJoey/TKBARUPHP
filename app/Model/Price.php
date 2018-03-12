<?php

namespace App\Model;

use Carbon\Carbon;
use App\Traits\StoreFilter;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Doctrine\Common\Collections\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Price
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $stock_id
 * @property integer $price_level_id
 * @property \Carbon\Carbon $input_date
 * @property float $market_price
 * @property float $price
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereStockId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price wherePriceLevelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereInputDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereMarketPrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Price withoutTrashed()
 * @property-read \App\Model\PriceLevel $priceLevel
 */
class Price extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at', 'input_date'];

    protected $fillable = [
        'store_id',
        'stock_id',
        'price_level_id',
        'input_date',
        'market_price',
        'price',
        'status'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function priceLevel()
    {
        return $this->belongsTo('App\Model\PriceLevel', 'price_level_id');
    }

    /**
     * Bulk save prices
     *
     * @param Collection $prices collection of prices to be saved.
     * @return boolean
     */
    public static function saveAll($prices)
    {
        $now = Carbon::now();
        $user = Auth::user();
        $prices = $prices->map(function ($data) use ($now, $user) {
            return array_merge([
                'created_by' => $user->id,
                'updated_by' => $user->id,
                'created_at' => $now,
                'updated_at' => $now,
            ], $data);
        })->all();

        return Price::insert($prices);
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
