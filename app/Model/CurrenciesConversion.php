<?php

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * App\Model\CurrenciesConversion
 *
 * @property int $id
 * @property int $store_id
 * @property int $currencies_id
 * @property bool $is_base
 * @property float $conversion_value
 * @property string $remarks
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Currencies $currencies
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CurrenciesConversion whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CurrenciesConversion whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CurrenciesConversion whereCurrenciesId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CurrenciesConversion whereIsBase($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CurrenciesConversion whereConversionValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CurrenciesConversion whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CurrenciesConversion whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CurrenciesConversion whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CurrenciesConversion whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CurrenciesConversion whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CurrenciesConversion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CurrenciesConversion whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CurrenciesConversion onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CurrenciesConversion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\CurrenciesConversion withoutTrashed()
 */
class CurrenciesConversion extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $table = 'currencies_conversion'; 
	protected $fillable = [
        'store_id',
        'currencies_id',
        'is_base',
        'conversion_value',
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
    public function currencies()
    {
        return $this->belongsTo('App\Model\CUrrencies', 'currencies_id');
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
