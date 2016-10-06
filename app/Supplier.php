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
 */
class Supplier extends Model
{
    protected $table = 'supplier';

    protected $fillable = [
        'supplier_name', 'supplier_address', 'supplier_city', 'phone_number', 'fax_num', 'tax_id', 'status', 'remarks',
    ];

    public function getProfile()
    {
        return $this->belongsToMany('App\Profile', 'supplier_profile', 'supplier_id', 'profile_id');
    }
    public function getBank()
    {
    	return $this->belongsToMany('App\BankAccount', 'supplier_bank_account');
    }

    public function getProducts()
    {
        return $this->belongsToMany('App\Product', 'supplier_prod');
    }
}