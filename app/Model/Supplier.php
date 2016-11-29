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
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Supplier
 *
 * @mixin \Eloquent
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $phone_number
 * @property string $fax_num
 * @property string $tax_id
 * @property string $remarks
 * @property string $status
 * @property integer $payment_due_day
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Profile[] $pic
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\BankAccount[] $bank
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Product[] $products
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier wherePhoneNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereFaxNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereTaxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier wherePaymentDueDay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Supplier whereDeletedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Profile[] $profiles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\BankAccount[] $bankAccounts
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\PurchaseOrder[] $purchaseOrders
 * @property integer $store_id
 * @property-read \App\Model\Store $store
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Supplier whereStoreId($value)
 */
class Supplier extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'suppliers';

    protected $fillable = [
        'store_id',
        'name',
        'address',
        'city',
        'phone_number',
        'fax_num',
        'tax_id',
        'payment_due_day',
        'status',
        'remarks',
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

    public function products()
    {
        return $this->belongsToMany('App\Model\Product', 'supplier_prod');
    }

    public function purchaseOrders()
    {
        return $this->hasMany('App\Model\PurchaseOrder');
    }

    public function store()
    {
        return $this->belongsTo('App\Model\Store', 'store_id');
    }

    public function expenseTemplates()
    {
        return $this->belongsToMany('App\Model\ExpenseTemplate', 'supplier_expense_template');
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