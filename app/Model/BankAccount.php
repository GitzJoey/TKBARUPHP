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
 * App\Model\BankAccount
 *
 * @property integer $id
 * @property integer $bank_id
 * @property integer $owner_id
 * @property string $account_number
 * @property string $remarks
 * @property string $owner_type
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Bank $bank
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $owner
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount whereBankId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount whereOwnerId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount whereAccountNumber($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount whereOwnerType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount whereDeletedAt($value)
 * @mixin \Eloquent
 * @property string $account_name
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount whereAccountName($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\BankAccount withoutTrashed()
 */
class BankAccount extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'bank_accounts';

    protected $fillable = [
        'bank_id',
        'account_name',
        'account_number',
        'remarks'
    ];

    protected $hidden = [
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'deleted_by',
        'deleted_at',
        'owner_type'
    ];

    public function bank()
    {
        return $this->belongsTo('App\Model\Bank', 'bank_id');
    }

    public function owner(){
        // Supplier | Customer | Store
        return $this->morphTo();
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
