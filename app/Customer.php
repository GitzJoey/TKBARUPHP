<?php
// PetengDedet

namespace App;

use \Illuminate\Database\Eloquent\Model;

/**
 * App\Customer
 *
 * @mixin \Eloquent
 */
class Customer extends Model
{
    protected $table = 'customers';
	protected $fillable = [
        'name', 'address', 'city', 'phone', 'remarks', 'tax_id', 'payment_due_day'
    ];

    public function profile()
    {
        return $this->hasMany('\App\Profile', 'phone_number', 'phone');
    }

    public function bank()
    {
        // return $this->hasMany('\App\Bank');
    }
}
