<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 12:07 AM
 */

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Items
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $store_id
 * @property integer $product_id
 * @property integer $stocks_id
 * @property integer $selected_unit_id
 * @property integer $base_unit_id
 * @property float $conversion_value
 * @property float $quantity
 * @property float $price
 * @property float $to_base_quantity
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Items whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Items whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Items whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Items whereStocksId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Items whereSelectedUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Items whereBaseUnitId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Items whereConversionValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Items whereQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Items wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Items whereToBaseQuantity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Items whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Items whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Items whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Items whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Items whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Items whereDeletedAt($value)
 * @property-read \App\Model\Product $product
 * @property-read \App\Model\ProductUnit $selectedUnit
 */
class Items extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'items';

    protected $fillable = [
        'quantity',
    ];

    public function product(){
        return $this->belongsTo('App\Model\Product', 'product_id');
    }

    public function selectedUnit(){
        return $this->belongsTo('App\Model\ProductUnit', 'selected_unit_id');
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