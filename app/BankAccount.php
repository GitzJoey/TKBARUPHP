<?php

/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:22 AM
 */

namespace App;

use \Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'bank_account';

    protected $fillable = [
        'bank_id','account_number', 'status', 'remarks'
    ];

    public function supplier()
    {
    	return $this->belongsToMany('App\Supplier', 'supplier_bank_account');
    }

    public function bank()
    {
    	return $this->belongsTo('App\Bank');
    }
}