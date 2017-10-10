<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 2/24/2017
 * Time: 5:11 AM
 */

namespace App\Model\Accounting;

use App\Traits\StoreFilter;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Model\Accounting\CashFlow
 *
 * @property int $id
 * @property int $store_id
 * @property string $date
 * @property int $from_cash_account_id
 * @property int $to_cash_account_id
 * @property float $amount
 * @property string $remarks
 * @property int $created_by
 * @property int $updated_by
 * @property int $deleted_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $deleted_at
 * @property-read \App\Model\Accounting\CashAccount $fromCashAccount
 * @property-read \App\Model\Accounting\CashAccount $toCashAccount
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow whereStoreId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow whereDate($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow whereFromCashAccountId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow whereToCashAccountId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow whereAmount($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow whereRemarks($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow whereCreatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow whereUpdatedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow whereDeletedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow whereDeletedAt($value)
 * @mixin \Eloquent
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Model\Accounting\CashFlow withoutTrashed()
 */
class CashFlow extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'acc_cash_flow';

    protected $appends = ['codeAndName'];

    protected $fillable = [
        'store_id',
        'from_cash_account_id',
        'to_cash_account_id',
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

    public function fromCashAccount()
    {
        return $this->belongsTo('App\Model\Accounting\CashAccount', 'from_cash_account_id');
    }

    public function toCashAccount()
    {
        return $this->belongsTo('App\Model\Accounting\CashAccount', 'to_cash_account_id');
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