<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 12:44 AM
 */

namespace App\Model;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\PriceLevel
 *
 * @mixin \Eloquent
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
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereWeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereIncrementValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel wherePercentageValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\PriceLevel whereDeletedAt($value)
 */
class PriceLevel extends Model
{
    use SoftDeletes;

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