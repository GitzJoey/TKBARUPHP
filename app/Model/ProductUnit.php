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
 * App\ProductUnit
 *
 * @property integer $id
 * @property integer $product_id
 * @property integer $store_id
 * @property integer $unit_id
 * @property boolean $is_base
 * @property float $conversion_value
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereIsBase($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereConversionValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductUnit whereDeletedAt($value)
 */
class ProductUnit extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'product_units';

    protected $fillable = [
        'product_id', 'unit_id', 'is_base', 'conversion_value', 'remarks'
    ];

    public function product() {
        return $this->belongsTo('App\Model\Product');
    }

    public function unit() {
        return $this->belongsTo('App\Model\Unit', 'unit_id');
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function($model)
        {
            $user = Auth::user();
            if ($user) {
                $model->created_by = $user->id;
                $model->updated_by = $user->id;
            }
        });

        static::updating(function($model)
        {
            $user = Auth::user();
            if ($user) {
                $model->updated_by = $user->id;
            }
        });

        static::deleting(function($model)
        {
            $user = Auth::user();
            if ($user) {
                $model->deleted_by = $user->id;
                $model->save();
            }
        });
    }
}