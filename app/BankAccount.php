<?php

/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:22 AM
 */

namespace App;

use \Illuminate\Database\Eloquent\Model;

/**
 * App\BankAccount
 *
 * @property integer $id
 * @property integer $bank_id
 * @property string $account_number
 * @property string $remarks
 * @property string $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Supplier[] $supplier
 * @property-read \App\Bank $bank
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereBankId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereAccountNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\BankAccount whereDeletedAt($value)
 * @mixin \Eloquent
 */
class BankAccount extends Model
{
    protected $table = 'bank_account';

    protected $fillable = [
        'bank_id','account_number', 'remarks'
    ];

    public function supplier()
    {
    	return $this->belongsToMany('App\Supplier', 'supplier_bank_account');
    }

    public function getBank()
    {
    	return $this->belongsTo('App\Bank');
    }
}