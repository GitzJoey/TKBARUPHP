<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:17 AM
 */

namespace App;

use \Illuminate\Database\Eloquent\Model;
 
/**
 * App\Supplier
 *
 * @mixin \Eloquent
 */
class Supplier extends Model
{
    protected $table = 'supplier';

    protected $fillable = [
        'supplier_name', 'supplier_address', 'supplier_city', 'phone_number', 'fax_num', 'tax_id', 'status', 'remarks',
    ];

    public function pic()
    {
        return $this->belongsToMany('App\Profile', 'supplier_pic', 'supplier_id', 'profile_id');
    }
    public function bank()
    {
    	return $this->belongsToMany('App\BankAccount', 'supplier_bank_account');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'supplier_prod');
    }
}