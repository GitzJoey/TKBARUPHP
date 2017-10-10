<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 1/28/2017
 * Time: 11:57 PM
 */

namespace App\Model\Accounting;

use App\Traits\StoreFilter;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\AccountingCash
 *
 * @property int $id
 * @property int $store_id
 * @property string $code
 * @property string $name
 * @property bool $is_default
 * @property string $status
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AccountingCash whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AccountingCash whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AccountingCash whereCode($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AccountingCash whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AccountingCash whereIsDefault($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AccountingCash whereStatus($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AccountingCash whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AccountingCash whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AccountingCash whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AccountingCash whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AccountingCash whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\AccountingCash whereDeletedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $code_and_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Accounting\CapitalDeposit[] $accountingCapitalDeposits
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Accounting\CapitalWithdrawal[] $accountingCapitalWithdrawals
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Accounting\Cost[] $accountingCosts
 * @property string $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Accounting\CapitalDeposit[] $capitalDeposits
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Accounting\CapitalWithdrawal[] $capitalWithdrawals
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Accounting\Cost[] $costs
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Accounting\Revenue[] $revenues
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashAccount whereType($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashAccount onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashAccount withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashAccount withoutTrashed()
 */
class CashAccount extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'acc_cash_account';

    protected $appends = ['codeAndName'];

    protected $fillable = [
        'store_id',
        'type',
        'code',
        'name',
        'is_default',
        'status',
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

    public function getCodeAndNameAttribute()
    {
        return $this->attributes['name'].' ('.$this->attributes['code'].')';
    }

    public function capitalDeposits()
    {
        return $this->hasMany('App\Model\Accounting\CapitalDeposit', 'destination_cash_account_id');
    }

    public function capitalWithdrawals()
    {
        return $this->hasMany('App\Model\Accounting\CapitalWithdrawal', 'source_cash_account_id');
    }

    public function costs()
    {
        return $this->hasMany('App\Model\Accounting\Cost', 'source_cash_account_id');
    }

    public function revenues()
    {
        return $this->hasMany('App\Model\Accounting\Revenue', 'destination_cash_account_id');
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