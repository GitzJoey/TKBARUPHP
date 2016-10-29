<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/9/2016
 * Time: 10:30 PM
 */

namespace App\Model;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Model\ProductUnit;

/**
 * App\Unit
 *
 * @property integer $id
 * @property string $name
 * @property string $symbol
 * @property string $status
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereSymbol($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @property-read mixed $unit_name
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Unit whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductUnit[] $productUnits
 */
class Unit extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'units';

    protected $fillable = [
        'name',
        'symbol',
        'status',
        'remarks',
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function getUnitNameAttribute()
    {
        return $this->attributes['name'] . ' (' . $this->attributes['symbol'] . ')';
    }

    public function productUnits()
    {
        return $this->hasMany('App\Model\ProductUnit', 'unit_id');
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