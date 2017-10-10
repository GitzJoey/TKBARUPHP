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
 * App\Model\Unit
 *
 * @property integer $id
 * @property string $name
 * @property string $symbol
 * @property string $status
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read mixed $unit_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductUnit[] $productUnits
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\WarehouseSection[] $capacityUnits
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Unit whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Unit whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Unit whereSymbol($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Unit whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Unit whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Unit whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Unit whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Unit whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Unit whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Unit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Unit whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Unit onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Unit withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Unit withoutTrashed()
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

    public function getUnitNameAttribute()
    {
        return $this->attributes['name'] . ' (' . $this->attributes['symbol'] . ')';
    }

    public function productUnits()
    {
        return $this->hasMany('App\Model\ProductUnit', 'unit_id');
    }

    public function capacityUnits()
    {
        return $this->hasMany('App\Model\WarehouseSection', 'capacity_unit_id');
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