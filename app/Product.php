<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:17 AM
 */

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\Product
 *
 * @property integer $id
 * @property string $type
 * @property string $name
 * @property string $short_code
 * @property string $description
 * @property string $image_path
 * @property string $status
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereShortCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereImagePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $store_id
 * @property integer $product_type_id
 * @property-read \App\Store $store
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProductUnit[] $productUnitList
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereProductTypeId($value)
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Product whereDeletedAt($value)
 */
class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'store_id', 'type', 'name', 'short_code', 'description', 'image_path', 'status', 'remarks'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function getStore()
    {
        return $this->belongsTo('\App\Store', 'store_id');
    }

    public function getType()
    {
        return $this->belongsTo('\App\ProductType', 'product_type_id');
    }

    public function getProductUnit()
    {
        return $this->hasMany('\App\ProductUnit');
    }
}