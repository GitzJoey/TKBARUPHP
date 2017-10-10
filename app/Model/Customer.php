<?php
// PetengDedet

namespace App\Model;

use Auth;
use App\Traits\StoreFilter;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Customer
 *
 * @property integer $id
 * @property integer $store_id
 * @property string $sign_code
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $phone_number
 * @property string $fax_num
 * @property string $tax_id
 * @property integer $payment_due_day
 * @property integer $price_level_id
 * @property string $status
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Profile[] $profiles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BankAccount[] $bankAccounts
 * @property-read \App\Model\PriceLevel $priceLevel
 * @property-read \App\Model\Store $store
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\ExpenseTemplate[] $expenseTemplates
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereSignCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer wherePhoneNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereFaxNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereTaxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer wherePaymentDueDay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer wherePriceLevelId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereDeletedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\SalesOrder[] $sales_orders
 * @property float $latitude
 * @property float $longitude
 * @property int $distance
 * @property string $distance_text
 * @property int $duration
 * @property string $duration_text
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereDistance($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereDistanceText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereDuration($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereDurationText($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereLatitude($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer whereLongitude($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Customer withoutTrashed()
 */
class Customer extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'customers';

    protected $fillable = [
        'store_id',
        'name',
        'address',
        'latitude',
        'longitude',
        'distance',
        'distance_text',
        'duration',
        'duration_text',
        'city',
        'phone_number',
        'tax_id',
        'payment_due_day',
        'price_level_id',
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

    public function profiles()
    {
        return $this->morphMany('App\Model\Profile', 'owner');
    }

    public function bankAccounts()
    {
        return $this->morphMany('App\Model\BankAccount', 'owner');
    }

    public function priceLevel()
    {
        return $this->belongsTo('App\Model\PriceLevel', 'price_level_id');
    }

    public function store()
    {
        return $this->belongsTo('App\Model\Store', 'store_id');
    }

    public function sales_orders()
    {
        return $this->hasMany('App\Model\SalesOrder');
    }

    public function expenseTemplates()
    {
        return $this->belongsToMany('App\Model\ExpenseTemplate', 'customer_expense_template');
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
