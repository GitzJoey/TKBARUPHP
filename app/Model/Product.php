<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:17 AM
 */

namespace App\Model;

use Auth;
use App\Traits\StoreFilter;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Product
 *
 * @property integer $id
 * @property integer $store_id
 * @property integer $product_type_id
 * @property string $name
 * @property string $short_code
 * @property string $description
 * @property string $image_path
 * @property string $status
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Store $store
 * @property-read \App\Model\ProductType $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductUnit[] $productUnits
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereProductTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereShortCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereImagePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereDeletedAt($value)
 * @mixin \Eloquent
 * @property string $barcode
 * @property int $minimal_in_stock
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ProductCategory[] $productCategories
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereBarcode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereMinimalInStock($value)
 * @property int $minimum_in_stock
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product whereMinimumInStock($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Product withoutTrashed()
 * @property-read mixed $base_unit_symbol
 */
class Product extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'products';

    protected $fillable = [
        'store_id',
        'product_type_id',
        'name',
        'short_code',
        'barcode',
        'description',
        'image_path',
        'minimal_in_stock',
        'status',
        'remarks'
    ];

    protected $appends = [
        'baseUnitSymbol'
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

    public function productCategories()
    {
        return $this->hasMany('App\Model\ProductCategory');
    }

    public function getBaseUnitSymbolAttribute()
    {
        $ret = '';
        foreach ($this->productUnits as $produnit) {
            if ($produnit->is_base) {
                $ret = $produnit->unit->symbol;
            }
        }
        return $ret;
    }

    public function getProductUnitsJSON()
    {
        $pu = array();

        foreach ($this->productUnits as $produnit) {
            array_push($pu, array(
                'selected' => false,
                'unit_id' => (string)$produnit->unit_id,
                'is_base' => empty($produnit->is_base) ? false : true,
                'is_base_val' => empty($produnit->is_base) ? false : true,
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