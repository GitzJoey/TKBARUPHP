<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:17 AM
 */

namespace App\Model;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductUnit[] $productUnits
 */
class Product extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'products';

    protected $fillable = [
        'store_id',
        'product_type_id',
        'name',
        'short_code',
        'description',
        'image_path',
        'status',
        'remarks'
    ];

    public function hId()
    {
        return HashIds::encode($this->attributes['id']);
    }

    public function store()
    {
        return $this->belongsTo('App\Model\Store', 'store_id');
    }

    public function type()
    {
        return $this->belongsTo('App\Model\ProductType', 'product_type_id');
    }

    public function productUnits()
    {
        return $this->hasMany('App\Model\ProductUnit');
    }

    public function getProductUnitsJSON()
    {
        $pu = array();

        foreach ($this->getProductUnit as $produnit) {
            array_push($pu, array(
                'unit_id' => (string)$produnit->unit_id,
                'is_base' => empty($produnit->is_base) ? false : true,
                'conversion_value' => $produnit->conversion_value,
                'remarks' => $produnit->remarks,
            ));
        }

        return json_encode($pu);
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