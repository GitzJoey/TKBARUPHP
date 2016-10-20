<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/7/2016
 * Time: 9:46 AM
 */

namespace App\Model;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Store
 *
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $phone_num
 * @property string $fax_num
 * @property string $tax_id
 * @property string $status
 * @property string $is_default
 * @property string $remarks
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store wherePhoneNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereFaxNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereTaxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereIsDefault($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $image_filename
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereImageFilename($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $user
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property string $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Store whereDeletedAt($value)
 */
class Store extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'store';

    protected $fillable = [
        'name', 'address', 'phone_num', 'fax_num', 'tax_id', 'status', 'is_default', 'image_filename', 'remarks'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function users()
    {
        return $this->hasMany('App\User', 'store_id');
    }

    public function products()
    {
        return $this->hasMany('App\Model\Product', 'store_id');
    }

    public function purchaseOrders()
    {
        return $this->hasMany('App\Model\PurchaseOrder');
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