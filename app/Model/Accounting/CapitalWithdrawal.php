<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 2/5/2017
 * Time: 8:38 AM
 */

namespace App\Model\Accounting;

use App\Traits\StoreFilter;

use Auth;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Accounting\CapitalWithdrawal
 *
 * @property int $id
 * @property int $store_id
 * @property string $date
 * @property int $source_acc_cash_id
 * @property float $amount
 * @property string $remarks
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Accounting\CashAccount $cashAccount
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal whereSourceAccCashId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal whereDeletedAt($value)
 * @mixin \Eloquent
 * @property int $source_cash_account_id
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal whereSourceCashAccountId($value)
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CapitalWithdrawal withoutTrashed()
 */
class CapitalWithdrawal extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'acc_capital_withdrawal';

    protected $fillable = [
        'store_id',
        'date',
        'source_cash_account_id',
        'amount',
        'remarks',
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

    public function cashAccount()
    {
        return $this->belongsTo('App\Model\Accounting\CashAccount', 'source_cash_account_id');
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