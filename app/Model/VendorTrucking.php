<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/22/2016
 * Time: 3:16 AM
 */

namespace App\Model;

use Auth;
use App\Traits\StoreFilter;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\VendorTrucking
 *
 * @property integer $id
 * @property integer $store_id
 * @property string $name
 * @property string $address
 * @property string $tax_id
 * @property string $status
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BankAccount[] $bankAccounts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PurchaseOrder[] $purchaseOrders
 * @property-read \App\Model\Store $store
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking whereTaxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\VendorTrucking withoutTrashed()
 */
class VendorTrucking extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'vendor_truckings';

    protected $fillable = [
        'store_id',
        'name',
        'address',
        'tax_id',
        'status',
        'remarks'
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

    public function bankAccounts()
    {
        return $this->hasMany('App\Model\BankAccount');
    }

    public function purchaseOrders()
    {
        return $this->hasMany('App\Model\PurchaseOrder');
    }

    public function store()
    {
        return $this->belongsTo('App\Model\Store');
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