<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 12:44 AM
 */

namespace App\Model;

use Auth;
use App\Traits\StoreFilter;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\PriceLevel
 *
 * @property integer $id
 * @property integer $store_id
 * @property string $type
 * @property integer $weight
 * @property string $name
 * @property string $description
 * @property integer $increment_value
 * @property integer $percentage_value
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel whereIncrementValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel wherePercentageValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel whereDeletedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $i18n_type
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\PriceLevel withoutTrashed()
 */
class PriceLevel extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'price_levels';

    protected $fillable = [
        'store_id',
        'type',
        'weight',
        'name',
        'description',
        'increment_value',
        'percentage_value',
        'status',
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    protected $appends = [
        'i18nType',
    ];

    public function getI18nTypeAttribute()
    {
        return trans('lookup.' . $this->attributes['type']);
    }

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
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