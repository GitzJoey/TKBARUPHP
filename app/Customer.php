<?php
// PetengDedet

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use \Illuminate\Database\Eloquent\Model;

/**
 * App\Customer
 *
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Profile[] $profile
 */
class Customer extends Model
{
    protected $table = 'customer';

	protected $fillable = [
        'name', 'address', 'city', 'phone_number', 'remarks', 'tax_id', 'payment_due_day'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function getProfiles()
    {
        return $this->belongsToMany('App\Profile', 'customer_pic', 'customer_id', 'profile_id');
    }

    public function getBankAccount()
    {
        return $this->belongsToMany('App\BankAccount', 'customer_bank_account', 'customer_id', 'bank_account_id');
    }
}
