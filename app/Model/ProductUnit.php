<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 12:57 PM
 */

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\ProductUnit
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $unit_id
 * @property boolean $is_base
 * @property float $conversion_value
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Product $product
 * @property-read \App\Model\Unit $unit
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductUnit whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductUnit whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductUnit whereUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductUnit whereIsBase($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductUnit whereConversionValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductUnit whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductUnit whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductUnit whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductUnit whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductUnit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductUnit whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductUnit onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductUnit withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductUnit withoutTrashed()
 */
class ProductUnit extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'product_units';

    protected $fillable = [
        'product_id',
        'unit_id',
        'is_base',
        'conversion_value',
        'remarks'
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }

    public function unit()
    {
        return $this->belongsTo('App\Model\Unit', 'unit_id');
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