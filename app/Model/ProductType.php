<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 1:40 PM
 */

namespace App\Model;

use Auth;
use App\Traits\StoreFilter;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\ProductType
 *
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
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Store $store
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Product[] $products
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Stock[] $stocks
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductType whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductType whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductType whereShortCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductType whereDescription($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductType whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductType whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductType whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductType whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductType whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductType whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductType onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductType withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\ProductType withoutTrashed()
 */
class ProductType extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'product_types';

    protected $fillable = [
        'store_id',
        'name',
        'short_code',
        'description',
        'status'
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
        return $this->belongsTo('App\Model\Store');
    }

    public function products()
    {
        return $this->hasMany('App\Model\Product', 'product_type_id');
    }

    public function stocks()
    {
        return $this->hasManyThrough('App\Model\Stock', 'App\Model\Product');
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