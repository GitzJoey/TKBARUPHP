<?php
// PetengDedet

namespace App\Model;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Customer
 *
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Profile[] $profile
 * @property integer $id
 * @property string $name
 * @property string $address
 * @property string $city
 * @property string $phone_number
 * @property string $fax_num
 * @property string $tax_id
 * @property integer $payment_due_day
 * @property string $remarks
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCity($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer wherePhoneNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereFaxNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereTaxId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer wherePaymentDueDay($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Customer whereDeletedAt($value)
 */
class Customer extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'customer';

	protected $fillable = [
        'name', 'address', 'city', 'phone_number', 'remarks', 'tax_id', 'payment_due_day'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function profile()
    {
        return $this->belongsToMany('App\Model\Profile', 'customer_pic', 'customer_id', 'profile_id');
    }

    public function bankAccount()
    {
        return $this->belongsToMany('App\Model\BankAccount', 'customer_bank_account', 'customer_id', 'bank_account_id');
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
