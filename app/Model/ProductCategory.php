<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 1/25/2017
 * Time: 11:06 PM
 */

namespace App\Model;

use Auth;

use App\Traits\StoreFilter;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\ProductCategory
 *
 * @property int $id
 * @property int $store_id
 * @property int $product_id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property int $level
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Store $store
 * @property-read \App\Model\Product $product
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereProductId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereLevel($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductCategory withoutTrashed()
 */
class ProductCategory extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'product_categories';

    protected $fillable = [
        'store_id',
        'code',
        'name',
        'description',
        'level',
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
    ];

    public function store()
    {
        return $this->belongsTo('App\Model\Store', 'store_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Model\Product');
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