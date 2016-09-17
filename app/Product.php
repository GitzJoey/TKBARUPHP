<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:17 AM
 */

namespace App;

use \Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

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
 */
class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'type', 'name', 'short_code', 'description', 'image_path', 'status', 'remarks'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function store()
    {
        return $this->belongsTo('\App\Store', 'store_id');
    }

    public function type()
    {
        return $this->belongsTo('\App\ProductType', 'product_type_id');
    }

    public function productUnitList()
    {
        return $this->hasMany('\App\ProductUnit');
    }
}