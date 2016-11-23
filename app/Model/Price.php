<?php

namespace App\Model;

use Carbon\Carbon;
use Doctrine\Common\Collections\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class Price extends Model
{
    use SoftDeletes;

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
