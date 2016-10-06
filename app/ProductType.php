<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 1:40 PM
 */

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * App\ProductType
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property integer $store_id
 * @property string $name
 * @property string $short_code
 * @property string $description
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $product
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereShortCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\ProductType whereDeletedAt($value)
 */
class ProductType extends Model
{
    protected $table = 'product_type';

    protected $fillable = [
        'store_id', 'name', 'short_code', 'description', 'status'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function getProduct()
    {
        return $this->hasMany('App\Product', 'product_type_id');
    }
}