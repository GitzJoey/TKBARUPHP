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