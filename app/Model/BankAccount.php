<?php

/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:22 AM
 */

namespace App\Model;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'bank_account';

    protected $fillable = [
        'bank_id','account_number', 'remarks'
    ];

    public function suppliers()
    {
    	return $this->belongsToMany('App\Model\Supplier', 'supplier_bank_account');
    }

    public function bank()
    {
    	return $this->belongsTo('App\Model\Bank', 'bank_id');
    }

    public function customers()
    {
        return $this->belongsToMany('App\Model\Customer', 'customer_bank_account', 'customer_id', 'bank_account_id');
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